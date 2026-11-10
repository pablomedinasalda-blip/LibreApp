
<style>
    .libre-sidebar {
        background: #172b4d !important;
        color: #ffffff !important;
        box-shadow: 5px 0 25px rgba(15, 30, 55, 0.15);
    }

    .libre-brand {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 25px 22px;
        color: #ffffff !important;
        border-bottom: 1px solid rgba(255,255,255,.12);
    }

    .libre-brand-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #d9a441;
        color: #172b4d;
        font-size: 24px;
        font-weight: 800;
    }

    .libre-brand-name {
        color: #ffffff !important;
        font-size: 19px;
        font-weight: 800;
        letter-spacing: 1.5px;
    }

    .libre-brand-description {
        color: #cbd5e1;
        font-size: 12px;
        margin-top: 3px;
    }

    .libre-menu-label {
        padding: 25px 22px 12px;
        color: #d9a441;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .libre-nav-list {
        padding: 0 13px;
    }

    .libre-nav-link {
        display: flex;
        align-items: center;
        gap: 13px;
        margin: 5px 0;
        padding: 13px 15px;
        border-radius: 10px;
        color: #dce5f1 !important;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all .2s ease;
    }

    .libre-nav-link:hover {
        background: #294c72 !important;
        color: #ffffff !important;
        transform: translateX(3px);
    }

    .libre-nav-link.active {
        background: #294c72 !important;
        color: #ffffff !important;
        border-left: 4px solid #d9a441;
        font-weight: 700;
    }

    .libre-nav-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 23px;
        font-size: 19px;
        color: #d9a441;
    }

    .libre-sidebar-bottom {
        padding: 20px 16px;
        border-top: 1px solid rgba(255,255,255,.12);
    }

    .libre-user-name {
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        overflow-wrap: anywhere;
    }

    .libre-user-email {
        color: #bdc9d9;
        font-size: 12px;
        margin-top: 5px;
        overflow-wrap: anywhere;
    }

    .libre-logout {
        width: 100%;
        margin-top: 12px;
        padding: 12px 15px;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 10px;
        background: transparent;
        color: #ffffff;
        text-align: left;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s ease;
    }

    .libre-logout:hover {
        background: #d9a441;
        color: #172b4d;
        border-color: #d9a441;
    }

    .libre-mobile-bar {
        display: none;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        background: #172b4d;
        color: #ffffff;
        box-shadow: 0 3px 12px rgba(0,0,0,.12);
    }

    .libre-mobile-toggle {
        border: none;
        border-radius: 8px;
        padding: 7px 12px;
        background: #d9a441;
        color: #172b4d;
        font-size: 23px;
        cursor: pointer;
    }

    .libre-mobile-overlay {
        position: fixed;
        inset: 0;
        z-index: 40;
        background: rgba(10,20,35,.65);
    }

    [x-cloak] {
        display: none !important;
    }

    @@media (max-width: 767px) {
        .libre-mobile-bar {
            display: flex;
        }

        .libre-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
            width: 280px;
            max-width: 85%;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform .25s ease;
        }

        .libre-sidebar.is-open {
            transform: translateX(0);
        }
    }
</style>

<div x-data="{ open: false }">

    {{-- Barra superior para móviles --}}
    <div class="libre-mobile-bar">
        <div class="libre-brand-name">LIBREAPP</div>

        <button type="button"
                class="libre-mobile-toggle"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-label="Abrir menú">
            ☰
        </button>
    </div>

    {{-- Fondo oscuro del menú móvil --}}
    <div x-show="open"
         x-cloak
         class="libre-mobile-overlay"
         @click="open = false">
    </div>

    {{-- Menú lateral --}}
    <aside class="libre-sidebar"
           :class="{ 'is-open': open }">

        <a href="{{ route('dashboard') }}"
           class="libre-brand"
           style="text-decoration:none">

            <div class="libre-brand-icon">L</div>

            <div>
                <div class="libre-brand-name">LIBREAPP</div>
                <div class="libre-brand-description">Biblioteca Virtual</div>
            </div>
        </a>

        <div class="libre-menu-label">Menú principal</div>

        <nav class="libre-nav-list">

            <a href="{{ route('dashboard') }}"
               class="libre-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               @click="open = false">
                <span class="libre-nav-icon">⌂</span>
                Dashboard
            </a>

            @auth

                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('books.index') }}"
                       class="libre-nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">▤</span>
                        Libros
                    </a>

                    <a href="{{ route('authors.index') }}"
                       class="libre-nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">♙</span>
                        Autores
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="libre-nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">▦</span>
                        Categorías
                    </a>

                    <a href="{{ route('loans.index') }}"
                       class="libre-nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">⇄</span>
                        Préstamos
                    </a>

                @else

                    <a href="{{ route('catalog.index') }}"
                       class="libre-nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">▤</span>
                        Catálogo
                    </a>

                    <a href="{{ route('loans.index') }}"
                       class="libre-nav-link {{ request()->routeIs('loans.index') || request()->routeIs('loans.show') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">⇄</span>
                        Mis préstamos
                    </a>

                    <a href="{{ route('loans.create') }}"
                       class="libre-nav-link {{ request()->routeIs('loans.create') ? 'active' : '' }}"
                       @click="open = false">
                        <span class="libre-nav-icon">＋</span>
                        Solicitar préstamo
                    </a>

                @endif

            @else

                <a href="{{ route('catalog.index') }}"
                   class="libre-nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">
                    <span class="libre-nav-icon">▤</span>
                    Catálogo
                </a>

            @endauth

        </nav>

        <div class="libre-sidebar-bottom">

            @auth

                <div class="libre-user-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="libre-user-email">
                    {{ Auth::user()->email }}
                </div>

                <a href="{{ route('profile.edit') }}"
                   class="libre-nav-link"
                   style="margin-top:12px">
                    <span class="libre-nav-icon">⚙</span>
                    Mi perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="libre-logout">
                        ↪ Cerrar sesión
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}" class="libre-nav-link">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}" class="libre-nav-link">
                    Registrarse
                </a>

            @endauth

        </div>

    </aside>
</div>
