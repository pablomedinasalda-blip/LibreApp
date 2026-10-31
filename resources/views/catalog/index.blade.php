
<x-app-layout>

    <div style="max-width: 1200px; margin: 30px auto; padding: 20px;">

        {{-- Encabezado --}}
        <div style="text-align: center; margin-bottom: 30px;">
            <h1 style="font-size: 32px; font-weight: bold; color: #1f2937;">
                Catálogo de LibreApp
            </h1>

            <p style="color: #6b7280; margin-top: 8px;">
                Explora nuestra colección de libros y encuentra tu próxima lectura.
            </p>
        </div>

        {{-- Buscador --}}
        <form action="{{ route('catalog.index') }}" method="GET"
              style="display: flex; gap: 10px; margin-bottom: 30px;">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar por título, ISBN o autor..."
                style="flex: 1; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px;"
            >

            <button type="submit"
                    style="background: #2563eb; color: white; padding: 12px 22px; border: none; border-radius: 6px; cursor: pointer;">
                Buscar
            </button>

            <a href="{{ route('catalog.index') }}"
               style="background: #6b7280; color: white; padding: 12px 22px; border-radius: 6px; text-decoration: none;">
                Limpiar
            </a>
        </form>

        {{-- Cantidad de resultados --}}
        <p style="margin-bottom: 20px; color: #6b7280;">
            Libros encontrados: {{ $books->total() }}
        </p>

        {{-- Mensaje cuando no hay libros --}}
        @if($books->isEmpty())

            <div style="background: #f3f4f6; padding: 30px; text-align: center; border-radius: 8px;">
                <h2 style="font-size: 20px; font-weight: bold;">
                    No se encontraron libros
                </h2>

                <p style="color: #6b7280; margin-top: 8px;">
                    Intenta buscar con otro título o nombre de autor.
                </p>
            </div>

        @else

            {{-- Tarjetas de libros --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 22px;">

                @foreach($books as $book)

                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 10px; padding: 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">

                        {{-- Portada --}}
                        @if($book->cover_image)
                            <img
                                src="{{ $book->cover_image }}"
                                alt="Portada de {{ $book->title }}"
                                style="width: 100%; height: 220px; object-fit: contain; margin-bottom: 15px;"
                            >
                        @else
                            <div style="height: 220px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; border-radius: 6px; color: #6b7280;">
                                Sin portada
                            </div>
                        @endif

                        {{-- Información --}}
                        <h2 style="font-size: 19px; font-weight: bold; color: #1f2937;">
                            {{ $book->title }}
                        </h2>

                        <p style="color: #6b7280; margin-top: 6px;">
                            Autor: {{ $book->author->name }}
                        </p>

                        <p style="color: #6b7280;">
                            Categoría: {{ $book->category->name }}
                        </p>

                        <p style="margin-top: 10px;">
                            @if($book->copies_available > 0)
                                <span style="color: #15803d; font-weight: bold;">
                                    Disponible: {{ $book->copies_available }}
                                </span>
                            @else
                                <span style="color: #dc2626; font-weight: bold;">
                                    No disponible
                                </span>
                            @endif
                        </p>

                        {{-- Ver detalles --}}
                        <a href="{{ route('catalog.show', $book) }}"
                           style="display: block; text-align: center; margin-top: 15px; background: #2563eb; color: white; padding: 10px; border-radius: 6px; text-decoration: none;">
                            Ver detalles
                        </a>

                    </div>

                @endforeach

            </div>

            {{-- Paginación --}}
            <div style="margin-top: 30px;">
                {{ $books->links() }}
            </div>

        @endif

    </div>

</x-app-layout>
