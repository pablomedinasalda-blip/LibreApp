#  LibreApp — Biblioteca Virtual

**Estudiante:** Juan Pablo Medina Saldarriaga

**Repositorio GitHub:** https://github.com/pablomedinasalda-blip/LibreApp

**Aplicación en producción:** https://libreapp.website

## 1. Descripción general

LibreApp es una aplicación web desarrollada con Laravel que permite gestionar una biblioteca virtual.

Los usuarios pueden consultar el catálogo de libros, visualizar sus detalles y solicitar préstamos. Por su parte, los administradores pueden gestionar libros, autores, categorías y solicitudes de préstamo.

La aplicación incorpora servicios externos para el envío de correos electrónicos, monitorización, almacenamiento de archivos y seguimiento de errores.

## 2. Tecnologías utilizadas

- **PHP 8.2:** lenguaje de programación.
- **Laravel 12:** framework de desarrollo backend.
- **MySQL / TiDB:** sistema de gestión de base de datos compatible con MySQL.
- **Blade:** motor de plantillas de Laravel.
- **Tailwind CSS y CSS:** diseño y estilos de la interfaz.
- **HTML y JavaScript:** desarrollo frontend.
- **Laravel Breeze:** autenticación de usuarios.
- **Vite:** compilación de recursos frontend.
- **Composer:** gestión de dependencias PHP.
- **Node.js y npm:** gestión de dependencias JavaScript.
- **Git y GitHub:** control de versiones.

## 3. Funcionalidades

###  Usuarios

- Registro e inicio de sesión.
- Consulta del catálogo público de libros.
- Búsqueda de libros por título, ISBN o autor.
- Visualización de detalles y disponibilidad.
- Solicitud de préstamos.
- Consulta del historial y estado de los préstamos.
- Recuperación de contraseñas mediante correo electrónico.

###  Administradores

- Gestión de libros (crear, consultar, actualizar y eliminar).
- Gestión de autores.
- Gestión de categorías.
- Aprobación y rechazo de solicitudes.
- Registro de devoluciones.
- Panel de control con estadísticas de la biblioteca.

###  Reglas de préstamos

- Cada usuario puede tener máximo tres préstamos activos.
- La duración de un préstamo es de 15 días.
- Al aprobar una solicitud, se descuenta una unidad del inventario disponible.
- Al registrar una devolución, se actualiza nuevamente la disponibilidad.
- No se pueden aprobar préstamos cuando no hay ejemplares disponibles.

## 4. Base de datos

El proyecto utiliza una base de datos compatible con MySQL. En producción se utiliza TiDB.

Las principales tablas son:

- `users`: usuarios y roles.
- `categories`: categorías de libros.
- `authors`: autores.
- `books`: información e inventario de libros.
- `loans`: solicitudes y registros de préstamos.

También se utilizan tablas auxiliares generadas por Laravel para autenticación, sesiones, caché y otras tareas del framework.

### Relaciones principales

- Un autor puede tener muchos libros.
- Una categoría puede tener muchos libros.
- Cada libro pertenece a un autor y a una categoría.
- Un usuario puede tener múltiples préstamos.
- Un libro puede estar asociado a múltiples registros de préstamos.

## 5. Instalación y ejecución local

### Requisitos previos

- PHP 8.2 o superior.
- Composer.
- Node.js y npm.
- MySQL o una base de datos compatible.
- Git.

### 5.1 Clonar el repositorio

```bash
git clone https://github.com/pablomedinasalda-blip/LibreApp.git
cd LibreApp
```

### 5.2 Instalar dependencias de PHP

```bash
composer install
```

### 5.3 Instalar dependencias de JavaScript

```bash
npm install
```

### 5.4 Configurar el archivo de entorno

Crear el archivo `.env` a partir del ejemplo:

```bash
copy .env.example .env
```

Configurar las credenciales de la base de datos en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=libreapp
DB_USERNAME=root
DB_PASSWORD=
```

Ajustar estos valores según la configuración de la base de datos utilizada.

### 5.5 Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5.6 Ejecutar las migraciones

Crear primero la base de datos `libreapp` y ejecutar:

```bash
php artisan migrate
```

### 5.7 Compilar los recursos

```bash
npm run build
```

### 5.8 Iniciar el servidor

```bash
php artisan serve
```

Para trabajar con Vite durante el desarrollo, ejecutar en otra terminal:

```bash
npm run dev
```

Abrir en el navegador:

http://127.0.0.1:8000

## 6. Variables de entorno

La aplicación utiliza variables de entorno para configurar los servicios y las conexiones externas.

**Importante:** las claves, contraseñas, tokens y credenciales reales no deben publicarse en GitHub.

### 6.1 Configuración general

```env
APP_NAME=LibreApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

### 6.2 Base de datos

```env
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 6.3 Resend

```env
MAIL_MAILER=resend
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"
RESEND_KEY=
```

### 6.4 Backblaze B2

```env
FILESYSTEM_DISK=local
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-005
AWS_BUCKET=libreapp-archivos
AWS_ENDPOINT=https://s3.us-east-005.backblazeb2.com
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### 6.5 Sentry

```env
SENTRY_LARAVEL_DSN=
```

Las variables de entorno se configuran localmente en `.env` y en producción mediante el panel de configuración del servicio de alojamiento.

## 7. Integraciones con servicios externos

### 7.1 Resend — Servicio de correo electrónico

Se integró Resend para gestionar el envío de correos electrónicos desde LibreApp.

Funciones principales:

- Envío de correos electrónicos.
- Recuperación de contraseñas.
- Configuración del remitente.
- Verificación del dominio de envío.

Dominio configurado: `libreapp.website`.

### 7.2 Better Stack — Monitorización

Se integró Better Stack para supervisar la disponibilidad de la aplicación.

Funciones principales:

- Monitorización periódica de la URL pública.
- Comprobación de disponibilidad.
- Detección de interrupciones.
- Notificaciones por correo electrónico ante incidentes.

URL supervisada: https://libreapp.website

### 7.3 Backblaze B2 — Almacenamiento externo

Se integró Backblaze B2 mediante su API compatible con el protocolo Amazon S3.

**Bucket configurado:** `libreapp-archivos`.

Funciones principales:

- Carga de portadas desde los formularios de libros.
- Almacenamiento externo de imágenes.
- Recuperación de archivos mediante enlaces temporales.
- Actualización de portadas.
- Eliminación de archivos asociados a libros eliminados.

La integración utiliza el sistema de archivos de Laravel y el adaptador Flysystem S3.

Las portadas se almacenan en Backblaze B2 y no dependen exclusivamente del almacenamiento local del servidor de producción.

### 7.4 Sentry — Seguimiento de errores

Se integró Sentry para supervisar y registrar errores de la aplicación.

Funciones principales:

- Captura de excepciones.
- Registro de errores.
- Seguimiento de incidentes.
- Diagnóstico de problemas en producción.

La integración facilita la identificación y el análisis de errores que puedan afectar el funcionamiento de LibreApp.

## 8. Seguridad y privacidad

La aplicación utiliza Laravel Breeze para gestionar la autenticación.

Entre las funcionalidades de seguridad se encuentran:

- Registro e inicio de sesión.
- Protección de rutas privadas mediante autenticación.
- Control de acceso según roles de usuario.
- Protección de formularios mediante tokens CSRF.
- Validación de datos recibidos.
- Recuperación de contraseñas.
- Protección de credenciales mediante variables de entorno.

Las operaciones administrativas están protegidas mediante middleware de roles.

La gestión de la privacidad y la eliminación de cuentas debe corresponder a las funcionalidades efectivamente implementadas en la aplicación.

## 9. Aplicación en producción

La aplicación se encuentra desplegada en Render.

**URL pública:** https://libreapp.website

**Repositorio:** https://github.com/pablomedinasalda-blip/LibreApp

La aplicación utiliza variables de entorno para conectar la base de datos y los servicios externos.

## 10. Evidencias de funcionamiento

Se incorporarán capturas de pantalla para demostrar el funcionamiento de la aplicación y las integraciones realizadas.

Evidencias recomendadas:

1. Página principal de LibreApp.
2. Catálogo público de libros.
3. Detalles de un libro.
4. Panel administrativo.
5. Gestión de libros.
6. Gestión de autores y categorías.
7. Solicitudes y administración de préstamos.
8. Recuperación de contraseñas mediante Resend.
9. Dominio verificado en Resend.
10. Monitor de disponibilidad en Better Stack.
11. Bucket y archivos almacenados en Backblaze B2.
12. Panel de eventos y errores de Sentry.
13. Aplicación desplegada en producción.

## 11. Autor

**Juan Pablo Medina Saldarriaga**

Proyecto académico: **LibreApp — Biblioteca Virtual**.

## 12. Licencia

Este proyecto utiliza Laravel, un framework de código abierto distribuido bajo licencia MIT. La licencia y las condiciones de uso del proyecto LibreApp deberán definirse según las necesidades de su autor.
