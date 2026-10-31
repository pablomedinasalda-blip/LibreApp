<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo y navegación principal --}}
            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @auth

                        @if(auth()->user()->role === 'admin')

                            <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.*')">
                                Libros
                            </x-nav-link>

                            <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.*')">
                                Autores
                            </x-nav-link>

                            <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                                Categorías
                            </x-nav-link>

                            <x-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.*')">
                                Préstamos
                            </x-nav-link>

                        @else

                            <x-nav-link :href="route('catalog.index')" :active="request()->routeIs('catalog.*')">
                                Catálogo
                            </x-nav-link>

                            <x-nav-link :href="route('loans.index')" :active="request()->routeIs('loans.index') || request()->routeIs('loans.show')">
                                Mis préstamos
                            </x-nav-link>

                            <x-nav-link :href="route('loans.create')" :active="request()->routeIs('loans.create')">
                                Solicitar préstamo
                            </x-nav-link>

                        @endif

                    @else

                        <x-nav-link :href="route('catalog.index')" :active="request()->routeIs('catalog.*')">
                            Catálogo
                        </x-nav-link>

                    @endauth

                </div>
            </div>

            {{-- Menú de usuario --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500">
                                {{ Auth::user()->name }}
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Mi perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>

                        </x-slot>

                    </x-dropdown>

                @else

                    <a href="{{ route('login') }}" class="text-sm text-gray-700 px-3">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="text-sm text-gray-700 px-3">
                        Registrarse
                    </a>

                @endauth

            </div>

            {{-- Botón menú móvil --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    {{-- Navegación móvil --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')

                <x-responsive-nav-link :href="route('books.index')">
                    Libros
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('authors.index')">
                    Autores
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('categories.index')">
                    Categorías
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('loans.index')">
                    Préstamos
                </x-responsive-nav-link>

            @else

                <x-responsive-nav-link :href="route('catalog.index')">
                    Catálogo
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('login')">
                    Iniciar sesión
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')">
                    Registrarse
                </x-responsive-nav-link>

            @endauth

        </div>

        {{-- Opciones del usuario en móvil --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Mi perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>

    </div>

</nav>
