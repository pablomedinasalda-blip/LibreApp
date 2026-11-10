
<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 style="font-size:24px; font-weight:800; color:#172b4d; margin:0;">
                Panel principal - LibreApp
            </h2>
            <p style="font-size:13px; color:#718096; margin-top:5px;">
                Biblioteca Virtual
            </p>
        </div>
    </x-slot>

    <div style="padding:15px 0 35px;">

        <div style="margin-bottom:30px;">
            <div style="
                background:linear-gradient(120deg,#172b4d,#294c72);
                border-radius:18px;
                padding:32px;
                color:#ffffff;
                box-shadow:0 8px 25px rgba(23,43,77,.15);
            ">
                <p style="font-size:13px; color:#d9a441; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;">
                    Bienvenido a LibreApp
                </p>

                <h1 style="font-size:29px; font-weight:800; margin-top:8px; color:#ffffff;">
                    ¡Hola, {{ auth()->user()->name }}!
                </h1>

                <p style="font-size:15px; color:#e2e8f0; margin-top:10px;">
                    @if(auth()->user()->role === 'admin')
                        Desde aquí puedes administrar los recursos de tu biblioteca virtual.
                    @else
                        Consulta tu actividad y descubre nuevos libros para leer.
                    @endif
                </p>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')

            {{-- PANEL DEL ADMINISTRADOR --}}

            <div style="margin-bottom:20px;">
                <h3 style="font-size:20px; font-weight:800; color:#172b4d;">
                    Estadísticas generales
                </h3>

                <p style="font-size:13px; color:#718096; margin-top:4px;">
                    Resumen del estado actual de LibreApp.
                </p>
            </div>

            @php
                $adminStats = [
                    ['Usuarios', $totalUsers, '♙'],
                    ['Libros', $totalBooks, '▤'],
                    ['Autores', $totalAuthors, '✎'],
                    ['Categorías', $totalCategories, '▦'],
                    ['Préstamos activos', $activeLoans, '⇄'],
                    ['Solicitudes pendientes', $pendingLoans, '◷'],
                    ['Préstamos vencidos', $overdueLoans, '!'],
                ];
            @endphp

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(210px,1fr));
                gap:20px;
            ">

                @foreach($adminStats as $stat)
                    <div style="
                        background:#ffffff;
                        padding:23px;
                        border-radius:15px;
                        border:1px solid #e7ebf1;
                        box-shadow:0 4px 15px rgba(23,43,77,.05);
                    ">
                        <div style="display:flex; align-items:center; justify-content:space-between;">
                            <p style="font-size:13px; color:#718096; font-weight:600;">
                                {{ $stat[0] }}
                            </p>

                            <span style="
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                width:40px;
                                height:40px;
                                border-radius:11px;
                                background:#fdf5e5;
                                color:#b88627;
                                font-size:21px;
                                font-weight:700;
                            ">
                                {{ $stat[2] }}
                            </span>
                        </div>

                        <p style="font-size:32px; font-weight:800; color:#172b4d; margin-top:14px;">
                            {{ $stat[1] }}
                        </p>

                        <div style="height:4px; background:#d9a441; border-radius:5px; margin-top:15px;"></div>
                    </div>
                @endforeach

            </div>

            <div style="margin-top:35px;">
                <h3 style="font-size:20px; font-weight:800; color:#172b4d; margin-bottom:18px;">
                    Accesos administrativos
                </h3>

                <div style="display:flex; flex-wrap:wrap; gap:12px;">

                    <a href="{{ route('books.index') }}"
                       style="background:#172b4d; color:#ffffff; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ▤ Gestionar libros
                    </a>

                    <a href="{{ route('authors.index') }}"
                       style="background:#294c72; color:#ffffff; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ♙ Gestionar autores
                    </a>

                    <a href="{{ route('categories.index') }}"
                       style="background:#294c72; color:#ffffff; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ▦ Gestionar categorías
                    </a>

                    <a href="{{ route('loans.index') }}"
                       style="background:#d9a441; color:#172b4d; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ⇄ Gestionar préstamos
                    </a>

                </div>
            </div>

        @else

            {{-- PANEL DEL LECTOR --}}

            <div style="margin-bottom:20px;">
                <h3 style="font-size:20px; font-weight:800; color:#172b4d;">
                    Mi actividad
                </h3>

                <p style="font-size:13px; color:#718096; margin-top:4px;">
                    Consulta el estado de tus préstamos.
                </p>
            </div>

            @php
                $readerStats = [
                    ['Préstamos activos', $myActiveLoans, '⇄'],
                    ['Solicitudes pendientes', $myPendingLoans, '◷'],
                    ['Libros devueltos', $myReturnedLoans, '✓'],
                    ['Préstamos vencidos', $myOverdueLoans, '!'],
                ];
            @endphp

            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(210px,1fr));
                gap:20px;
            ">

                @foreach($readerStats as $stat)
                    <div style="
                        background:#ffffff;
                        padding:23px;
                        border-radius:15px;
                        border:1px solid #e7ebf1;
                        box-shadow:0 4px 15px rgba(23,43,77,.05);
                    ">
                        <div style="display:flex; align-items:center; justify-content:space-between;">
                            <p style="font-size:13px; color:#718096; font-weight:600;">
                                {{ $stat[0] }}
                            </p>

                            <span style="
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                width:40px;
                                height:40px;
                                border-radius:11px;
                                background:#fdf5e5;
                                color:#b88627;
                                font-size:21px;
                                font-weight:700;
                            ">
                                {{ $stat[2] }}
                            </span>
                        </div>

                        <p style="font-size:32px; font-weight:800; color:#172b4d; margin-top:14px;">
                            {{ $stat[1] }}
                        </p>

                        <div style="height:4px; background:#d9a441; border-radius:5px; margin-top:15px;"></div>
                    </div>
                @endforeach

            </div>

            <div style="margin-top:35px;">
                <h3 style="font-size:20px; font-weight:800; color:#172b4d; margin-bottom:18px;">
                    Explora tu biblioteca
                </h3>

                <div style="display:flex; flex-wrap:wrap; gap:12px;">

                    <a href="{{ route('catalog.index') }}"
                       style="background:#172b4d; color:#ffffff; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ▤ Explorar catálogo
                    </a>

                    <a href="{{ route('loans.create') }}"
                       style="background:#d9a441; color:#172b4d; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ＋ Solicitar préstamo
                    </a>

                    <a href="{{ route('loans.index') }}"
                       style="background:#294c72; color:#ffffff; padding:13px 20px; border-radius:9px; text-decoration:none; font-weight:700; font-size:14px;">
                        ⇄ Mis préstamos
                    </a>

                </div>
            </div>

        @endif

    </div>

</x-app-layout>
