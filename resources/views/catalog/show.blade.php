
<x-app-layout>

    <div style="max-width: 1000px; margin: 35px auto; padding: 20px;">

        {{-- Botón regresar --}}
        <a href="{{ route('catalog.index') }}"
           style="display: inline-block; margin-bottom: 25px; color: #2563eb; text-decoration: none;">
            ← Volver al catálogo
        </a>

        {{-- Información del libro --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 35px; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">

            {{-- Portada --}}
            <div>
                @if($book->cover_image)

                    <img
                        src="{{ $book->cover_image }}"
                        alt="Portada de {{ $book->title }}"
                        style="width: 100%; max-height: 420px; object-fit: contain;"
                    >

                @else

                    <div style="height: 350px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #6b7280; border-radius: 8px;">
                        Sin portada disponible
                    </div>

                @endif
            </div>

            {{-- Datos del libro --}}
            <div>

                <h1 style="font-size: 30px; font-weight: bold; color: #1f2937; margin-bottom: 15px;">
                    {{ $book->title }}
                </h1>

                <p style="margin-bottom: 10px;">
                    <strong>Autor:</strong> {{ $book->author->name }}
                </p>

                <p style="margin-bottom: 10px;">
                    <strong>Categoría:</strong> {{ $book->category->name }}
                </p>

                <p style="margin-bottom: 10px;">
                    <strong>ISBN:</strong> {{ $book->isbn }}
                </p>

                <p style="margin-bottom: 10px;">
                    <strong>Año de publicación:</strong> {{ $book->year ?? 'No especificado' }}
                </p>

                <p style="margin-bottom: 10px;">
                    <strong>Ejemplares totales:</strong> {{ $book->copies_total }}
                </p>

                <p style="margin-bottom: 10px;">
                    <strong>Ejemplares disponibles:</strong> {{ $book->copies_available }}
                </p>

                {{-- Estado --}}
                <div style="margin-top: 20px;">

                    @if($book->copies_available > 0)

                        <span style="background: #dcfce7; color: #166534; padding: 8px 12px; border-radius: 5px; font-weight: bold;">
                            Disponible para préstamo
                        </span>

                    @else

                        <span style="background: #fee2e2; color: #991b1b; padding: 8px 12px; border-radius: 5px; font-weight: bold;">
                            Actualmente no disponible
                        </span>

                    @endif

                </div>

                {{-- Descripción --}}
                <div style="margin-top: 25px;">

                    <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 8px;">
                        Descripción
                    </h2>

                    <p style="color: #4b5563; line-height: 1.7;">
                        {{ $book->description ?: 'No hay una descripción disponible para este libro.' }}
                    </p>

                </div>

                {{-- Solicitar préstamo --}}
                <div style="margin-top: 25px;">

                    @auth

                        @if(auth()->user()->role === 'reader' && $book->copies_available > 0)

                            <a href="{{ route('loans.create', ['book_id' => $book->id]) }}"
                               style="display: inline-block; background: #2563eb; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none;">
                                Solicitar préstamo
                            </a>

                        @elseif(auth()->user()->role === 'reader')

                            <p style="color: #dc2626;">
                                No hay ejemplares disponibles para solicitar.
                            </p>

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                           style="display: inline-block; background: #2563eb; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none;">
                            Inicia sesión para solicitar un préstamo
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
