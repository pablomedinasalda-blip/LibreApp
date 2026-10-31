# 📚 LibreApp — Biblioteca Virtual

LibreApp es una aplicación web desarrollada con Laravel que permite gestionar una biblioteca virtual. Los usuarios pueden consultar el catálogo de libros y solicitar préstamos, mientras que los administradores pueden gestionar libros, autores, categorías y solicitudes de préstamo.

## 🚀 Tecnologías utilizadas

- **PHP 8.2**
- **Laravel 12**
- **MySQL 8.4**
- **Blade**
- **Bootstrap**
- **Laravel Breeze** para autenticación
- **HTML, CSS y JavaScript**

## ✨ Funcionalidades

### 👤 Usuarios
- Registro e inicio de sesión.
- Consulta del catálogo público de libros.
- Búsqueda de libros por título, ISBN o autor.
- Visualización de detalles y disponibilidad.
- Solicitud de préstamos.
- Consulta del historial y estado de los préstamos.

### 🔐 Administradores
- Gestión de libros (crear, consultar, actualizar y eliminar).
- Gestión de autores.
- Gestión de categorías.
- Aprobación y rechazo de solicitudes.
- Registro de devoluciones.
- Panel de control con estadísticas de la biblioteca.

### 📖 Reglas de préstamos
- Cada usuario puede tener máximo 3 préstamos activos.
- La duración de un préstamo es de 15 días.
- Al aprobar una solicitud, se descuenta una unidad del inventario disponible.
- Al registrar una devolución, se actualiza nuevamente la disponibilidad.
- No se pueden aprobar préstamos cuando no hay ejemplares disponibles.

## 🗄️ Base de datos

El proyecto utiliza MySQL y cuenta con las siguientes tablas principales:

- `users`: usuarios y roles.
- `categories`: categorías de libros.
- `authors`: autores.
- `books`: información e inventario de libros.
- `loans`: solicitudes y registros de préstamos.

También utiliza tablas auxiliares generadas por Laravel para autenticación, sesiones, caché y tareas.

## ⚙️ Instalación y ejecución local

### 1. Clonar el repositorio

```bash
git clone https://github.com/pablomedinasalda-blip/LibreApp.git
cd LibreApp
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript

```bash
npm install
```

### 4. Configurar el archivo de entorno

Crear el archivo `.env` a partir del ejemplo:

```bash
copy .env.example .env
```

Configurar las credenciales de la base de datos MySQL en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=libreapp
DB_USERNAME=root
DB_PASSWORD=
```

Ajustar estos valores según la configuración local de MySQL.

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar las migraciones

Crear primero la base de datos `libreapp` en MySQL y luego ejecutar:

```bash
php artisan migrate
```

### 7. Compilar los recursos

```bash
npm run build
```

### 8. Iniciar el servidor

```bash
php artisan serve
```

Abrir en el navegador:

```text
http://127.0.0.1:8000
```

## 👨‍💻 Autor

Proyecto académico desarrollado como práctica de desarrollo web con Laravel.

## 📄 Licencia

Este proyecto utiliza Laravel, un framework de código abierto bajo licencia MIT. La licencia y condiciones de uso del proyecto LibreApp deben definirse según las necesidades de su autor.
