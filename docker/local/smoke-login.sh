#!/usr/bin/env bash
# Prueba HTTP real del login contra Apache (imagen de producción).
# Muestra códigos de estado, nombres de cookies y resultados booleanos;
# nunca imprime valores de cookies, tokens ni credenciales.
#
# Uso: LOGIN_EMAIL=... LOGIN_PASSWORD=... docker/local/smoke-login.sh [URL_BASE]

set -euo pipefail

BASE_URL="${1:-http://127.0.0.1:8080}"
SESSION_COOKIE="${SESSION_COOKIE:-libreapp-session}"
: "${LOGIN_EMAIL:?Definir LOGIN_EMAIL}"
: "${LOGIN_PASSWORD:?Definir LOGIN_PASSWORD}"

WORK="$(mktemp -d)"
trap 'rm -rf "$WORK"' EXIT
FAILURES=0

check() {
    if [ "$2" = "$3" ]; then echo "  OK    $1 ($2)"; else echo "  FALLA $1 (obtenido: $2, esperado: $3)"; FAILURES=$((FAILURES + 1)); fi
}

status() { head -1 "$1" | awk '{print $2}'; }
cookie_names() { grep -i '^set-cookie:' "$1" | sed -E 's/^[Ss]et-[Cc]ookie: *([^=]+)=.*/\1/' | sort | tr '\n' ' '; }
has_header() { grep -qi "^$2:" "$1" && echo si || echo no; }
cookie_hash() { awk -v n="$2" '$6 == n {print $7}' "$1" | sha256sum | cut -c1-16; }
csrf_token() { grep -oE 'name="_token"[^>]*value="[^"]+"' "$1" | sed -E 's/.*value="([^"]+)"/\1/' | head -1; }

echo "1. GET /login"
curl -s -D "$WORK/h1" -o "$WORK/b1" -c "$WORK/jar" "$BASE_URL/login"
check "estado HTTP" "$(status "$WORK/h1")" 200
check "Set-Cookie de sesión" "$(grep -qi "^set-cookie: $SESSION_COOKIE=" "$WORK/h1" && echo si || echo no)" si
check "Set-Cookie XSRF-TOKEN" "$(grep -qi '^set-cookie: XSRF-TOKEN=' "$WORK/h1" && echo si || echo no)" si
check "encabezado Cache-Control" "$(has_header "$WORK/h1" cache-control)" si
check "primer byte del cuerpo es '<'" "$(head -c1 "$WORK/b1")" "<"
check "formulario con _token" "$([ -n "$(csrf_token "$WORK/b1")" ] && echo si || echo no)" si
echo "  cookies recibidas: $(cookie_names "$WORK/h1")"
TOKEN="$(csrf_token "$WORK/b1")"
SESSION_BEFORE="$(cookie_hash "$WORK/jar" "$SESSION_COOKIE")"

echo "2. POST /login con token CSRF inválido (con cookies)"
curl -s -D "$WORK/h2" -o "$WORK/b2" -b "$WORK/jar" \
    --data-urlencode "_token=token-invalido" --data-urlencode "email=$LOGIN_EMAIL" --data-urlencode "password=$LOGIN_PASSWORD" \
    "$BASE_URL/login"
check "estado HTTP" "$(status "$WORK/h2")" 419
check "cuerpo contiene 'Page Expired'" "$(grep -q 'Page Expired' "$WORK/b2" && echo si || echo no)" si

echo "3. POST /login con token válido pero sin cookie de sesión"
curl -s -D "$WORK/h3" -o /dev/null \
    --data-urlencode "_token=$TOKEN" --data-urlencode "email=$LOGIN_EMAIL" --data-urlencode "password=$LOGIN_PASSWORD" \
    "$BASE_URL/login"
check "estado HTTP" "$(status "$WORK/h3")" 419

echo "4. POST /login válido (cookies del paso 1 + token del formulario)"
curl -s -D "$WORK/h4" -o /dev/null -b "$WORK/jar" -c "$WORK/jar" \
    --data-urlencode "_token=$TOKEN" --data-urlencode "email=$LOGIN_EMAIL" --data-urlencode "password=$LOGIN_PASSWORD" \
    "$BASE_URL/login"
check "estado HTTP" "$(status "$WORK/h4")" 302
check "redirige a /dashboard" "$(grep -i '^location:' "$WORK/h4" | grep -q '/dashboard' && echo si || echo no)" si
check "sesión regenerada tras el login" "$([ "$SESSION_BEFORE" != "$(cookie_hash "$WORK/jar" "$SESSION_COOKIE")" ] && echo si || echo no)" si
echo "  cookies recibidas: $(cookie_names "$WORK/h4")"

echo "5. GET /dashboard con la sesión autenticada"
curl -s -D "$WORK/h5" -o /dev/null -b "$WORK/jar" "$BASE_URL/dashboard"
check "estado HTTP" "$(status "$WORK/h5")" 200

echo "6. GET /dashboard sin cookies"
curl -s -D "$WORK/h6" -o /dev/null "$BASE_URL/dashboard"
check "estado HTTP" "$(status "$WORK/h6")" 302

echo
if [ "$FAILURES" -eq 0 ]; then echo "RESULTADO: todas las comprobaciones pasaron"; else echo "RESULTADO: $FAILURES comprobación(es) fallaron"; exit 1; fi
