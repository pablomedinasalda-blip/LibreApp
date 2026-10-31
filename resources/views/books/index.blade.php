
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Gestión de libros
        </h2>
    </x-slot>

    <div style="padding: 30px;">

        <!-- Botón para registrar un nuevo libro -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('books.create') }}"
               style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                + Nuevo libro
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div style="background-color: #dcfce7; color: #166534; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de libros -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background-color: white;">
                <thead>
                <tr style="background-color: #e5e7eb;">
                    <th style="padding: 12px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Título</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">ISBN</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Autor</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Categoría</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Copias disponibles</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Estado</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->id }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->title }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->isbn }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->author->name ?? 'Sin autor' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->category->name ?? 'Sin categoría' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->copies_available }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $book->active ? 'Activo' : 'Inactivo' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; white-space: nowrap;">

                            <a href="{{ route('books.show', $book) }}"
                               style="color: #15803d; margin-right: 8px;">
                                Ver
                            </a>

                            <a href="{{ route('books.edit', $book) }}"
                               style="color: #2563eb; margin-right: 8px;">
                                Editar
                            </a>

                            <form action="{{ route('books.destroy', $book) }}"
                                  method="POST"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar este libro?')"
                                        style="background-color: #dc2626; color: white; padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer;">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"
                            style="padding: 20px; text-align: center; border: 1px solid #ddd;">
                            No hay libros registrados.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
