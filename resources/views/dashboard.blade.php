<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Panel principal - LibreApp
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    ¡Bienvenido, {{ auth()->user()->name }}!
                </h1>

                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    @if(auth()->user()->role === 'admin')
                        Panel de administración de LibreApp.
                    @else
                        Este es tu espacio personal de biblioteca virtual.
                    @endif
                </p>
            </div>

            @if(auth()->user()->role === 'admin')

                {{-- PANEL DEL ADMINISTRADOR --}}

                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
                    Estadísticas generales
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @php
                        $adminStats = [
                            ['Usuarios', $totalUsers],
                            ['Libros', $totalBooks],
                            ['Autores', $totalAuthors],
                            ['Categorías', $totalCategories],
                            ['Préstamos activos', $activeLoans],
                            ['Solicitudes pendientes', $pendingLoans],
                            ['Préstamos vencidos', $overdueLoans],
                        ];
                    @endphp

                    @foreach($adminStats as $stat)
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                {{ $stat[0] }}
                            </p>

                            <p class="text-3xl font-bold text-indigo-600 mt-2">
                                {{ $stat[1] }}
                            </p>
                        </div>
                    @endforeach

                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('books.index') }}"
                       class="bg-indigo-600 text-white px-5 py-3 rounded-lg">
                        Gestionar libros
                    </a>

                    <a href="{{ route('authors.index') }}"
                       class="bg-indigo-600 text-white px-5 py-3 rounded-lg">
                        Gestionar autores
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="bg-indigo-600 text-white px-5 py-3 rounded-lg">
                        Gestionar categorías
                    </a>

                    <a href="{{ route('loans.index') }}"
                       class="bg-green-600 text-white px-5 py-3 rounded-lg">
                        Gestionar préstamos
                    </a>
                </div>

            @else

                {{-- PANEL DEL LECTOR --}}

                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">
                    Mi actividad
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @php
                        $readerStats = [
                            ['Préstamos activos', $myActiveLoans],
                            ['Solicitudes pendientes', $myPendingLoans],
                            ['Libros devueltos', $myReturnedLoans],
                            ['Préstamos vencidos', $myOverdueLoans],
                        ];
                    @endphp

                    @foreach($readerStats as $stat)
                        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                {{ $stat[0] }}
                            </p>

                            <p class="text-3xl font-bold text-indigo-600 mt-2">
                                {{ $stat[1] }}
                            </p>
                        </div>
                    @endforeach

                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('catalog.index') }}"
                       class="bg-indigo-600 text-white px-5 py-3 rounded-lg">
                        Explorar catálogo
                    </a>

                    <a href="{{ route('loans.create') }}"
                       class="bg-green-600 text-white px-5 py-3 rounded-lg">
                        Solicitar préstamo
                    </a>

                    <a href="{{ route('loans.index') }}"
                       class="bg-gray-600 text-white px-5 py-3 rounded-lg">
                        Mis préstamos
                    </a>
                </div>

            @endif

        </div>
    </div>

</x-app-layout>
