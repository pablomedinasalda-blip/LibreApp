<?php

/*
 * Cualquier byte fuera de las etiquetas PHP en un archivo que se carga al
 * arrancar Laravel se envía antes que los encabezados. Con output_buffering
 * desactivado (imagen php:8.2-apache sin php.ini) se pierden el código de
 * estado y las cookies de sesión, y el login termina en 419 Page Expired.
 */

function phpFilesLoadedOnBoot(): array
{
    $root = dirname(__DIR__, 2);
    $files = [];

    foreach (['app', 'bootstrap', 'config', 'database', 'public', 'routes'] as $directory) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator("{$root}/{$directory}", FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            $path = $file->getPathname();

            if (str_ends_with($path, '.php') && ! str_contains($path, '/bootstrap/cache/')) {
                $files[] = substr($path, strlen($root) + 1);
            }
        }
    }

    sort($files);

    return $files;
}

test('los archivos PHP del arranque empiezan exactamente con <?php', function () {
    $root = dirname(__DIR__, 2);

    $invalid = array_values(array_filter(
        phpFilesLoadedOnBoot(),
        fn (string $file) => ! str_starts_with(file_get_contents("{$root}/{$file}"), '<?php')
    ));

    expect($invalid)->toBe([]);
});

test('los archivos PHP del arranque no tienen etiqueta de cierre', function () {
    $root = dirname(__DIR__, 2);

    $invalid = array_values(array_filter(
        phpFilesLoadedOnBoot(),
        fn (string $file) => preg_match('/\?>\s*$/', file_get_contents("{$root}/{$file}")) === 1
    ));

    expect($invalid)->toBe([]);
});
