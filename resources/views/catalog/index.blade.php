
<x-app-layout>

    <div style="max-width:1400px; margin:0 auto; padding:25px 0 40px;">

        {{-- ENCABEZADO --}}
        <div style="
            background:linear-gradient(120deg,#172b4d,#294c72);
            padding:35px;
            border-radius:18px;
            color:#ffffff;
            margin-bottom:30px;
            box-shadow:0 8px 25px rgba(23,43,77,.12);
        ">
            <p style="color:#d9a441; font-size:12px; font-weight:800; letter-spacing:2px;">
                DESCUBRE NUEVAS HISTORIAS
            </p>

            <h1 style="font-size:30px; font-weight:800; margin-top:8px; color:#ffffff;">
                Catálogo de LibreApp
            </h1>

            <p style="color:#e2e8f0; margin-top:10px; font-size:15px;">
                Explora nuestra colección de libros y encuentra tu próxima lectura.
            </p>
        </div>

        {{-- BUSCADOR --}}
        <div style="
            background:#ffffff;
            padding:22px;
            border-radius:15px;
            border:1px solid #e7ebf1;
            box-shadow:0 4px 15px rgba(23,43,77,.05);
            margin-bottom:25px;
        ">

            <form action="{{ route('catalog.index') }}" method="GET"
                  style="display:flex; flex-wrap:wrap; gap:12px;">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar por título, ISBN o autor..."
                    style="
                        flex:1;
                        min-width:220px;
                        padding:13px 16px;
                        border:1px solid #dce2eb;
                        border-radius:9px;
                        outline:none;
                        color:#26364b;
                        background:#ffffff;
                    "
                >

                <button type="submit"
                        style="
                            background:#172b4d;
                            color:#ffffff;
                            padding:12px 25px;
                            border:none;
                            border-radius:9px;
                            font-weight:700;
                            cursor:pointer;
                        ">
                    Buscar libros
                </button>

                <a href="{{ route('catalog.index') }}"
                   style="
                       background:#e9edf3;
                       color:#294c72;
                       padding:12px 22px;
                       border-radius:9px;
                       text-decoration:none;
                       font-weight:700;
                       display:flex;
                       align-items:center;
                       justify-content:center;
                   ">
                    Limpiar
                </a>

            </form>
        </div>

        {{-- RESULTADOS --}}
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:10px;
            margin-bottom:20px;
        ">
            <h2 style="font-size:19px; font-weight:800; color:#172b4d;">
                Nuestra colección
            </h2>

            <span style="
                background:#fdf5e5;
                color:#946c1c;
                padding:8px 14px;
                border-radius:20px;
                font-size:13px;
                font-weight:700;
            ">
                {{ $books->total() }} libros encontrados
            </span>
        </div>

        {{-- SIN RESULTADOS --}}
        @if($books->isEmpty())

            <div style="
                background:#ffffff;
                padding:55px 25px;
                text-align:center;
                border-radius:15px;
                border:1px solid #e7ebf1;
                box-shadow:0 4px 15px rgba(23,43,77,.05);
            ">
                <div style="font-size:48px; color:#d9a441;">▤</div>

                <h2 style="font-size:21px; font-weight:800; color:#172b4d; margin-top:12px;">
                    No se encontraron libros
                </h2>

                <p style="color:#718096; margin-top:8px;">
                    Intenta buscar con otro título o nombre de autor.
                </p>

                <a href="{{ route('catalog.index') }}"
                   style="
                       display:inline-block;
                       margin-top:20px;
                       background:#172b4d;
                       color:#ffffff;
                       padding:11px 22px;
                       border-radius:9px;
                       text-decoration:none;
                       font-weight:700;
                   ">
                    Ver todos los libros
                </a>
            </div>

        @else

            {{-- TARJETAS DE LIBROS --}}
            <div style="
                display:grid;
                grid-template-columns:repeat(auto-fit,minmax(235px,1fr));
                gap:22px;
            ">

                @foreach($books as $book)

                    <div style="
                        background:#ffffff;
                        border:1px solid #e7ebf1;
                        border-radius:15px;
                        padding:18px;
                        box-shadow:0 4px 15px rgba(23,43,77,.05);
                        transition:transform .2s ease, box-shadow .2s ease;
                        display:flex;
                        flex-direction:column;
                    ">

                        {{-- PORTADA --}}
                        @if($book->cover_image)

                            <div style="
                                height:235px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:#f4f6fa;
                                border-radius:10px;
                                margin-bottom:17px;
                                overflow:hidden;
                            ">
                                <img
                                    src="{{ $book->cover_image }}"
                                    alt="Portada de {{ $book->title }}"
                                    style="
                                        width:100%;
                                        height:100%;
                                        object-fit:contain;
                                    "
                                >
                            </div>

                        @else

                            <div style="
                                height:235px;
                                background:#f4f6fa;
                                display:flex;
                                flex-direction:column;
                                align-items:center;
                                justify-content:center;
                                margin-bottom:17px;
                                border-radius:10px;
                                color:#294c72;
                            ">
                                <span style="font-size:55px; color:#d9a441;">▤</span>
                                <span style="font-size:13px; margin-top:8px;">
                                    Sin portada
                                </span>
                            </div>

                        @endif

                        {{-- INFORMACIÓN --}}
                        <div style="flex:1;">

                            <h2 style="
                                font-size:17px;
                                font-weight:800;
                                color:#172b4d;
                                line-height:1.4;
                            ">
                                {{ $book->title }}
                            </h2>

                            <p style="color:#718096; font-size:13px; margin-top:10px;">
                                <strong style="color:#294c72;">Autor:</strong>
                                {{ $book->author->name }}
                            </p>

                            <p style="color:#718096; font-size:13px; margin-top:5px;">
                                <strong style="color:#294c72;">Categoría:</strong>
                                {{ $book->category->name }}
                            </p>

                            {{-- DISPONIBILIDAD --}}
                            <div style="margin-top:17px;">

                                @if($book->copies_available > 0)

                                    <span style="
                                        display:inline-block;
                                        background:#e8f5ed;
                                        color:#187344;
                                        padding:7px 11px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:700;
                                    ">
                                        ✓ Disponible: {{ $book->copies_available }}
                                    </span>

                                @else

                                    <span style="
                                        display:inline-block;
                                        background:#fdecec;
                                        color:#b42318;
                                        padding:7px 11px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:700;
                                    ">
                                        ✕ No disponible
                                    </span>

                                @endif

                            </div>

                        </div>

                        {{-- VER DETALLES --}}
                        <a href="{{ route('catalog.show', $book) }}"
                           style="
                               display:block;
                               text-align:center;
                               margin-top:20px;
                               background:#172b4d;
                               color:#ffffff;
                               padding:12px;
                               border-radius:9px;
                               text-decoration:none;
                               font-size:14px;
                               font-weight:700;
                           ">
                            Ver detalles →
                        </a>

                    </div>

                @endforeach

            </div>

            {{-- PAGINACIÓN --}}
            <div style="
                margin-top:30px;
                padding:20px;
                background:#ffffff;
                border-radius:12px;
                border:1px solid #e7ebf1;
            ">
                {{ $books->links() }}
            </div>

        @endif

    </div>

</x-app-layout>
