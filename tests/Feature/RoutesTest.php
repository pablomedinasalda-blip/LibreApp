<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

test('todas las rutas usadas en vistas y controladores existen', function () {
    $used = [];

    foreach (['resources/views', 'app'] as $directory) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(base_path($directory)));

        foreach ($iterator as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.php')) {
                // Ignora $request->route('param'), que lee parámetros de la URL.
                preg_match_all("/(?<!->)\broute\(\s*'([a-z._]+)'/", file_get_contents($file->getPathname()), $matches);
                $used = array_merge($used, $matches[1]);
            }
        }
    }

    $missing = array_values(array_filter(
        array_unique($used),
        fn (string $name) => ! Route::has($name)
    ));

    expect($missing)->toBe([]);
});

test('todas las rutas apuntan a métodos existentes del controlador', function () {
    $missing = [];

    foreach (Route::getRoutes() as $route) {
        $action = $route->getActionName();

        if (str_starts_with($action, 'App\\') && str_contains($action, '@')) {
            [$controller, $method] = explode('@', $action);

            if (! method_exists($controller, $method)) {
                $missing[] = $action;
            }
        }
    }

    expect($missing)->toBe([]);
});

test('las páginas principales cargan para un lector', function (string $uri) {
    $this->actingAs(User::factory()->create(['role' => 'reader']))
        ->get($uri)
        ->assertOk();
})->with(['/dashboard', '/profile', '/catalogo', '/mis-prestamos', '/prestamos/solicitar']);

test('las páginas principales cargan para un administrador', function (string $uri) {
    $this->actingAs(User::factory()->create(['role' => 'admin']))
        ->get($uri)
        ->assertOk();
})->with(['/dashboard', '/mis-prestamos', '/libros', '/autores', '/categorias']);
