
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LibreApp, tu biblioteca virtual. Explora libros y administra tus préstamos desde cualquier lugar.">

    <title>LibreApp | Biblioteca Virtual</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

<!-- ====================================== -->
<!-- BARRA DE NAVEGACIÓN -->
<!-- ====================================== -->

<header class="sticky top-0 z-50 border-b border-slate-200 bg-white">
    <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-4 lg:px-10">

        <!-- LOGO -->
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-700 text-xl font-bold text-white shadow-md">
                L
            </div>

            <div>
                <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                    Libre<span class="text-indigo-600">App</span>
                </h1>
                <p class="text-xs font-medium tracking-wider text-slate-500">
                    BIBLIOTECA VIRTUAL
                </p>
            </div>
        </a>

        <!-- MENÚ -->
        <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6">

            <a href="{{ url('/') }}"
               class="text-sm font-semibold text-indigo-700 transition hover:text-indigo-500">
                Inicio
            </a>

            <a href="{{ route('catalog.index') }}"
               class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                Catálogo
            </a>

            @auth

                <a href="{{ route('dashboard') }}"
                   class="rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-800">
                    Mi cuenta
                </a>

            @else

                <a href="{{ route('login') }}"
                   class="text-sm font-semibold text-slate-700 transition hover:text-indigo-600">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                   class="rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:bg-indigo-800">
                    Registrarse
                </a>

            @endauth

        </div>
    </nav>
</header>


<!-- ====================================== -->
<!-- SECCIÓN PRINCIPAL / HERO -->
<!-- ====================================== -->

<main>

    <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-900">

        <!-- DECORACIÓN -->
        <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-indigo-500 opacity-20 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-20 h-96 w-96 rounded-full bg-blue-500 opacity-20 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-14 px-6 py-20 md:grid-cols-2 md:py-28 lg:px-10">

            <!-- TEXTO PRINCIPAL -->
            <div class="text-center md:text-left">

                <span class="inline-block rounded-full border border-indigo-300/30 bg-indigo-400/10 px-4 py-2 text-sm font-semibold text-indigo-200">
                    ✦ Tu espacio para descubrir conocimiento
                </span>

                <h2 class="mt-7 text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Un mundo de historias está
                    <span class="text-indigo-300">
                        esperando por ti.
                    </span>
                </h2>

                <p class="mx-auto mt-6 max-w-xl text-base leading-8 text-slate-300 md:mx-0 md:text-lg">
                    Explora nuestra biblioteca virtual, encuentra tus próximos libros favoritos y administra tus préstamos de manera fácil, rápida y desde cualquier lugar.
                </p>

                <!-- BOTONES -->
                <div class="mt-9 flex flex-wrap items-center justify-center gap-4 md:justify-start">

                    <a href="{{ route('catalog.index') }}"
                       class="inline-flex min-h-12 items-center justify-center rounded-xl bg-indigo-500 px-7 py-3 font-bold text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:bg-indigo-400">
                        Explorar catálogo →
                    </a>

                    @guest

                        <a href="{{ route('register') }}"
                           class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/30 px-7 py-3 font-semibold text-white transition duration-300 hover:bg-white hover:text-indigo-900">
                            Crear cuenta
                        </a>

                    @else

                        <a href="{{ route('dashboard') }}"
                           class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/30 px-7 py-3 font-semibold text-white transition duration-300 hover:bg-white hover:text-indigo-900">
                            Ir a mi cuenta
                        </a>

                    @endguest

                </div>

                <!-- INFORMACIÓN -->
                <div class="mt-12 flex flex-wrap justify-center gap-8 border-t border-white/15 pt-8 md:justify-start">

                    <div>
                        <p class="text-2xl font-extrabold text-white">24/7</p>
                        <p class="mt-1 text-sm text-slate-400">Acceso virtual</p>
                    </div>

                    <div>
                        <p class="text-2xl font-extrabold text-white">Fácil</p>
                        <p class="mt-1 text-sm text-slate-400">Gestión de préstamos</p>
                    </div>

                    <div>
                        <p class="text-2xl font-extrabold text-white">Libre</p>
                        <p class="mt-1 text-sm text-slate-400">Acceso al catálogo</p>
                    </div>

                </div>
            </div>


            <!-- ILUSTRACIÓN -->
            <div class="flex justify-center">

                <div class="relative flex h-80 w-full max-w-md items-center justify-center rounded-3xl border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur-sm sm:h-96">

                    <div class="absolute left-5 top-5 rounded-xl bg-white/10 px-4 py-2 text-sm font-medium text-white">
                        📚 Biblioteca digital
                    </div>

                    <div class="flex items-center gap-2">

                        <!-- LIBRO 1 -->
                        <div class="flex h-48 w-24 -rotate-12 items-center justify-center rounded-l-lg border-r-4 border-indigo-950 bg-indigo-400 shadow-xl sm:h-60 sm:w-28">
                            <span class="text-3xl font-black text-white">L</span>
                        </div>

                        <!-- LIBRO 2 -->
                        <div class="z-10 flex h-56 w-28 items-center justify-center rounded-lg border-r-4 border-blue-950 bg-blue-500 shadow-2xl sm:h-72 sm:w-32">
                            <div class="text-center">
                                <span class="text-4xl">📖</span>
                                <p class="mt-3 text-lg font-extrabold text-white">LEER</p>
                                <div class="mx-auto mt-2 h-1 w-12 rounded bg-blue-200"></div>
                            </div>
                        </div>

                        <!-- LIBRO 3 -->
                        <div class="flex h-48 w-24 rotate-12 items-center justify-center rounded-r-lg border-l-4 border-purple-950 bg-purple-500 shadow-xl sm:h-60 sm:w-28">
                            <span class="text-3xl font-black text-white">A+</span>
                        </div>

                    </div>

                    <div class="absolute bottom-5 right-5 rounded-xl bg-white px-4 py-3 text-sm font-bold text-indigo-800 shadow-lg">
                        ✨ Descubre algo nuevo
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- ====================================== -->
    <!-- BENEFICIOS -->
    <!-- ====================================== -->

    <section class="mx-auto max-w-7xl px-6 py-20 lg:px-10">

        <div class="mb-14 text-center">

            <span class="text-sm font-bold uppercase tracking-widest text-indigo-600">
                Conoce LibreApp
            </span>

            <h2 class="mt-3 text-3xl font-extrabold text-slate-900 sm:text-4xl">
                Tu biblioteca, más cerca que nunca
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-slate-500">
                Todo lo que necesitas para disfrutar de la lectura y gestionar tus libros en un solo lugar.
            </p>

        </div>


        <div class="grid gap-7 md:grid-cols-3">

            <!-- BENEFICIO 1 -->
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-3xl">
                    📚
                </div>

                <h3 class="mt-6 text-xl font-bold text-slate-900">
                    Catálogo de libros
                </h3>

                <p class="mt-3 leading-7 text-slate-500">
                    Explora los libros disponibles, descubre nuevos autores y encuentra lecturas interesantes.
                </p>

                <a href="{{ route('catalog.index') }}"
                   class="mt-6 inline-block font-bold text-indigo-600 transition hover:text-indigo-800">
                    Ver catálogo →
                </a>

            </div>


            <!-- BENEFICIO 2 -->
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-3xl">
                    📖
                </div>

                <h3 class="mt-6 text-xl font-bold text-slate-900">
                    Gestión de préstamos
                </h3>

                <p class="mt-3 leading-7 text-slate-500">
                    Solicita préstamos y consulta el estado de tus libros de forma sencilla.
                </p>

                @auth
                    <a href="{{ route('loans.index') }}"
                       class="mt-6 inline-block font-bold text-indigo-600 transition hover:text-indigo-800">
                        Mis préstamos →
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="mt-6 inline-block font-bold text-indigo-600 transition hover:text-indigo-800">
                        Iniciar sesión →
                    </a>
                @endauth

            </div>


            <!-- BENEFICIO 3 -->
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-xl">

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 text-3xl">
                    💻
                </div>

                <h3 class="mt-6 text-xl font-bold text-slate-900">
                    Acceso desde cualquier lugar
                </h3>

                <p class="mt-3 leading-7 text-slate-500">
                    Consulta nuestra biblioteca virtual desde tu computador, tableta o teléfono.
                </p>

                <a href="{{ route('catalog.index') }}"
                   class="mt-6 inline-block font-bold text-indigo-600 transition hover:text-indigo-800">
                    Comenzar ahora →
                </a>

            </div>

        </div>

    </section>


    <!-- ====================================== -->
    <!-- LLAMADO A LA ACCIÓN -->
    <!-- ====================================== -->

    <section class="mx-6 mb-20 overflow-hidden rounded-3xl bg-indigo-700 px-6 py-14 text-center shadow-xl sm:mx-10 lg:mx-auto lg:max-w-7xl">

        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
            Tu próxima lectura comienza aquí
        </h2>

        <p class="mx-auto mt-4 max-w-2xl leading-7 text-indigo-100">
            Explora nuestro catálogo y encuentra el libro que estás buscando.
        </p>

        <a href="{{ route('catalog.index') }}"
           class="mt-8 inline-flex items-center justify-center rounded-xl bg-white px-8 py-3 font-bold text-indigo-700 shadow-md transition hover:-translate-y-1 hover:bg-indigo-50">
            Explorar libros →
        </a>

    </section>

</main>


<!-- ====================================== -->
<!-- PIE DE PÁGINA -->
<!-- ====================================== -->

<footer class="border-t border-slate-200 bg-slate-950 px-6 py-10 text-center">

    <h2 class="text-2xl font-extrabold text-white">
        Libre<span class="text-indigo-400">App</span>
    </h2>

    <p class="mt-3 text-sm text-slate-400">
        Tu biblioteca virtual, un mundo de conocimiento.
    </p>

    <div class="mt-6 border-t border-white/10 pt-6">
        <p class="text-sm text-slate-500">
            © {{ date('Y') }} LibreApp - Biblioteca Virtual. Todos los derechos reservados.
        </p>
    </div>

</footer>

</body>
</html>
