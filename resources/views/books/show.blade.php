
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Detalles del libro
        </h2>
    </x-slot>

    <div style="padding: 30px; max-width: 850px;">

        <div style="background-color: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">

            <h3 style="font-size: 22px; font-weight: bold; margin-bottom: 20px;">
                {{ $book->title }}
            </h3>

            <p style="margin-bottom: 12px;">
                <strong>ID:</strong> {{ $book->id }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>ISBN:</strong> {{ $book->isbn }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Autor:</strong> {{ $book->author->name ?? 'Sin autor' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Categoría:</strong> {{ $book->category->name ?? 'Sin categoría' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Descripción:</strong>
                {{ $book->description ?? 'Sin descripción' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Año de publicación:</strong>
                {{ $book->year ?? 'No especificado' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Total de copias:</strong> {{ $book->copies_total }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Copias disponibles:</strong> {{ $book->copies_available }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Estado:</strong>
                @if ($book->active)
                    <span style="color: green; font-weight: bold;">Activo</span>
                @else
                    <span style="color: red; font-weight: bold;">Inactivo</span>
                @endif
            </p>

            <p style="margin-bottom: 20px;">
                <strong>Fecha de registro:</strong>
                {{ $book->created_at->format('d/m/Y H:i') }}
            </p>

            <div style="margin-top: 25px;">

                <a href="{{ route('books.edit', $book) }}"
                   style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                    Editar libro
                </a>

                <a href="{{ route('books.index') }}"
                   style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">
                    Volver
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
