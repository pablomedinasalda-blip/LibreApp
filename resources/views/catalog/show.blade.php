<x-app-layout>

    <div style="max-width:1150px; margin:0 auto; padding:30px 0 45px;">

        {{-- VOLVER AL CATÁLOGO --}}
        <a href="{{ route('catalog.index') }}"
           style="
               display:inline-block;
               margin-bottom:22px;
               color:#294c72;
               text-decoration:none;
               font-size:14px;
               font-weight:700;
           ">
            ← Volver al catálogo
        </a>

        {{-- INFORMACIÓN DEL LIBRO --}}
        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:35px;
            background:#ffffff;
            padding:30px;
            border-radius:18px;
            border:1px solid #e7ebf1;
            box-shadow:0 5px 20px rgba(23,43,77,.07);
        ">

            {{-- PORTADA --}}
            <div style="
                background:#f4f6fa;
                border-radius:14px;
                padding:20px;
                display:flex;
                align-items:center;
                justify-content:center;
                min-height:350px;
            ">

                @if($book->cover_image)

                    @php
                        $coverUrl = str_starts_with($book->cover_image, 'portadas/')
                            ? \Illuminate\Support\Facades\Storage::disk('s3')->temporaryUrl(
                                $book->cover_image,
                                now()->addMinutes(15)
                            )
                            : $book->cover_image;
                    @endphp

                    <img
                        src="{{ $coverUrl }}"
                        alt="Portada de {{ $book->title }}"
                        style="
                            width:100%;
                            max-height:430px;
                            object-fit:contain;
                        "
                    >

                @else

                    <div style="
                        display:flex;
                        flex-direction:column;
                        align-items:center;
                        justify-content:center;
                        color:#294c72;
                    ">
                        <span style="font-size:65px; color:#d9a441;">▤</span>
                        <span style="font-size:14px; margin-top:12px;">
                            Sin portada disponible
                        </span>
                    </div>

                @endif

            </div>

            {{-- DATOS DEL LIBRO --}}
            <div>

                <span style="
                    display:inline-block;
                    background:#fdf5e5;
                    color:#946c1c;
                    padding:7px 13px;
                    border-radius:20px;
                    font-size:11px;
                    font-weight:800;
                    letter-spacing:1px;
                    text-transform:uppercase;
                ">
                    Ficha bibliográfica
                </span>

                <h1 style="
                    font-size:30px;
                    font-weight:800;
                    color:#172b4d;
                    margin-top:15px;
                    line-height:1.3;
                ">
                    {{ $book->title }}
                </h1>

                {{-- INFORMACIÓN BIBLIOGRÁFICA --}}
                <div style="
                    margin-top:25px;
                    border-top:1px solid #e7ebf1;
                    border-bottom:1px solid #e7ebf1;
                    padding:20px 0;
                ">

                    <p style="margin-bottom:13px; color:#718096;">
                        <strong style="color:#294c72;">Autor:</strong>
                        {{ $book->author->name }}
                    </p>

                    <p style="margin-bottom:13px; color:#718096;">
                        <strong style="color:#294c72;">Categoría:</strong>
                        {{ $book->category->name }}
                    </p>

                    <p style="margin-bottom:13px; color:#718096;">
                        <strong style="color:#294c72;">ISBN:</strong>
                        {{ $book->isbn }}
                    </p>

                    <p style="margin-bottom:13px; color:#718096;">
                        <strong style="color:#294c72;">Año de publicación:</strong>
                        {{ $book->year ?? 'No especificado' }}
                    </p>

                    <p style="margin-bottom:13px; color:#718096;">
                        <strong style="color:#294c72;">Ejemplares totales:</strong>
                        {{ $book->copies_total }}
                    </p>

                    <p style="color:#718096;">
                        <strong style="color:#294c72;">Ejemplares disponibles:</strong>
                        {{ $book->copies_available }}
                    </p>

                </div>

                {{-- ESTADO --}}
                <div style="margin-top:22px;">

                    @if($book->copies_available > 0)

                        <span style="
                            display:inline-block;
                            background:#e8f5ed;
                            color:#187344;
                            padding:9px 14px;
                            border-radius:20px;
                            font-size:13px;
                            font-weight:700;
                        ">
                            ✓ Disponible para préstamo
                        </span>

                    @else

                        <span style="
                            display:inline-block;
                            background:#fdecec;
                            color:#b42318;
                            padding:9px 14px;
                            border-radius:20px;
                            font-size:13px;
                            font-weight:700;
                        ">
                            ✕ Actualmente no disponible
                        </span>

                    @endif

                </div>

                {{-- DESCRIPCIÓN --}}
                <div style="margin-top:28px;">

                    <h2 style="
                        font-size:19px;
                        font-weight:800;
                        color:#172b4d;
                        margin-bottom:10px;
                    ">
                        Descripción del libro
                    </h2>

                    <p style="
                        color:#718096;
                        line-height:1.8;
                        font-size:14px;
                    ">
                        {{ $book->description ?: 'No hay una descripción disponible para este libro.' }}
                    </p>

                </div>

                {{-- SOLICITAR PRÉSTAMO --}}
                <div style="
                    margin-top:30px;
                    padding-top:22px;
                    border-top:1px solid #e7ebf1;
                ">

                    @auth

                        @if(auth()->user()->role === 'reader' && $book->copies_available > 0)

                            <a href="{{ route('loans.create', ['book_id' => $book->id]) }}"
                               style="
                                   display:inline-block;
                                   background:#172b4d;
                                   color:#ffffff;
                                   padding:13px 22px;
                                   border-radius:9px;
                                   text-decoration:none;
                                   font-size:14px;
                                   font-weight:700;
                               ">
                                Solicitar préstamo →
                            </a>

                        @elseif(auth()->user()->role === 'reader')

                            <p style="color:#b42318; font-size:14px; font-weight:600;">
                                No hay ejemplares disponibles para solicitar.
                            </p>

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                           style="
                               display:inline-block;
                               background:#d9a441;
                               color:#172b4d;
                               padding:13px 22px;
                               border-radius:9px;
                               text-decoration:none;
                               font-size:14px;
                               font-weight:700;
                           ">
                            Inicia sesión para solicitar un préstamo
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
