
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreApp | Biblioteca Virtual</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Barra de navegación -->
<header class="bg-white shadow">
    <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-indigo-700">
            LibreApp
        </h1>

        <div class="flex gap-4">
            <a href="{{ route('catalog.index') }}"
               class="text-gray-700 hover:text-indigo-600">
                Catálogo
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="text-indigo-600 font-semibold">
                    Mi cuenta
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-indigo-600 font-semibold">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Registrarse
                </a>
            @endauth
        </div>
    </nav>
</header>

<!-- Contenido principal -->
<main class="max-w-6xl mx-auto px-6 py-20 text-center">

    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
        Bienvenido a LibreApp
    </h2>

    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
        Tu biblioteca virtual. Explora nuestro catálogo,
        descubre nuevos libros y administra tus préstamos
        desde cualquier lugar.
    </p>

    <a href="{{ route('catalog.index') }}"
       class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700">
        Explorar catálogo
    </a>

</main>

<!-- Pie de página -->
<footer class="text-center py-6 text-gray-500 border-t bg-white">
    © {{ date('Y') }} LibreApp - Biblioteca Virtual
</footer>

</body>
</html>
