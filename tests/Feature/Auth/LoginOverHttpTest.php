<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;

/*
 * Estas pruebas levantan un servidor HTTP real sobre public/index.php, con
 * output_buffering desactivado como en la imagen php:8.2-apache. A diferencia
 * de $this->get() y $this->post(), recorren la SAPI real: si algún archivo
 * emite salida antes de los encabezados, se pierden el código de estado y las
 * cookies, y Laravel responde 200 con el contenido de "419 Page Expired".
 * El middleware CSRF está activo porque el servidor no corre en consola.
 */

beforeEach(function () {
    $this->database = tempnam(sys_get_temp_dir(), 'libreapp-http-');

    $env = [
        'APP_ENV' => 'production',
        'APP_DEBUG' => 'false',
        'DB_CONNECTION' => 'sqlite',
        'DB_URL' => '',
        'DB_DATABASE' => $this->database,
        'SESSION_DRIVER' => 'database',
        'CACHE_STORE' => 'array',
        'LOG_CHANNEL' => 'stderr',
    ];

    Process::path(base_path())->env($env)
        ->run([PHP_BINARY, 'artisan', 'migrate', '--force'])
        ->throw();

    $now = now()->toDateTimeString();

    (new PDO("sqlite:{$this->database}"))
        ->prepare('insert into users (name, email, email_verified_at, password, created_at, updated_at) values (?, ?, ?, ?, ?, ?)')
        ->execute(['Usuario de prueba', 'prueba@example.com', $now, Hash::make('password'), $now, $now]);

    $socket = stream_socket_server('tcp://127.0.0.1:0');
    $this->baseUrl = 'http://'.stream_socket_get_name($socket, false);
    fclose($socket);

    $this->server = Process::path(public_path())->env($env)->start([
        PHP_BINARY, '-d', 'output_buffering=0', '-S', substr($this->baseUrl, 7),
        base_path('vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php'),
    ]);

    $deadline = microtime(true) + 10;

    while (! @fsockopen(...explode(':', substr($this->baseUrl, 7)))) {
        if (microtime(true) > $deadline) {
            throw new RuntimeException('El servidor HTTP de pruebas no arrancó: '.$this->server->errorOutput());
        }

        usleep(50_000);
    }

    $this->sessionCookie = config('session.cookie');
});

afterEach(function () {
    $this->server->stop();

    @unlink($this->database);
});

/**
 * Envía una petición sin seguir redirecciones y devuelve la respuesta junto
 * con las cookies recibidas en Set-Cookie (nombre => valor).
 */
function sendHttp(string $method, string $url, array $form = [], array $cookies = []): array
{
    $request = Http::withOptions(['allow_redirects' => false])->accept('text/html');

    if ($cookies !== []) {
        $request = $request->withHeaders([
            'Cookie' => implode('; ', array_map(
                fn ($name, $value) => "{$name}={$value}", array_keys($cookies), $cookies
            )),
        ]);
    }

    $response = $method === 'POST'
        ? $request->asForm()->post($url, $form)
        : $request->get($url);

    $received = [];

    foreach ($response->toPsrResponse()->getHeader('Set-Cookie') as $header) {
        [$name, $value] = explode('=', strtok($header, ';'), 2);
        $received[$name] = $value;
    }

    return [$response, $received];
}

function csrfTokenFrom(string $html): string
{
    preg_match('/name="_token"\s+value="([^"]+)"/', $html, $matches);

    return $matches[1] ?? '';
}

test('GET /login responde 200 con encabezados y cookies de sesión', function () {
    [$response, $cookies] = sendHttp('GET', "{$this->baseUrl}/login");

    expect($response->status())->toBe(200)
        ->and($response->body())->toStartWith('<!DOCTYPE html>')
        ->and($response->header('Cache-Control'))->toContain('no-cache')
        ->and($cookies)->toHaveKeys([$this->sessionCookie, 'XSRF-TOKEN'])
        ->and(csrfTokenFrom($response->body()))->not->toBe('');
});

test('POST /login con token CSRF inválido devuelve un 419 real', function () {
    [, $cookies] = sendHttp('GET', "{$this->baseUrl}/login");

    [$response] = sendHttp('POST', "{$this->baseUrl}/login", [
        '_token' => 'token-invalido',
        'email' => 'prueba@example.com',
        'password' => 'password',
    ], $cookies);

    expect($response->status())->toBe(419);
});

test('POST /login sin la cookie de sesión devuelve un 419 real', function () {
    [$login] = sendHttp('GET', "{$this->baseUrl}/login");

    [$response] = sendHttp('POST', "{$this->baseUrl}/login", [
        '_token' => csrfTokenFrom($login->body()),
        'email' => 'prueba@example.com',
        'password' => 'password',
    ]);

    expect($response->status())->toBe(419);
});

test('el login válido conserva la sesión entre GET y POST', function () {
    [$login, $cookies] = sendHttp('GET', "{$this->baseUrl}/login");

    [$response, $authenticatedCookies] = sendHttp('POST', "{$this->baseUrl}/login", [
        '_token' => csrfTokenFrom($login->body()),
        'email' => 'prueba@example.com',
        'password' => 'password',
    ], $cookies);

    expect($response->status())->toBe(302)
        ->and($response->header('Location'))->toEndWith('/dashboard')
        ->and($authenticatedCookies)->toHaveKey($this->sessionCookie)
        ->and($authenticatedCookies[$this->sessionCookie])->not->toBe($cookies[$this->sessionCookie]);

    [$dashboard] = sendHttp('GET', "{$this->baseUrl}/dashboard", [], array_merge($cookies, $authenticatedCookies));

    expect($dashboard->status())->toBe(200);
});
