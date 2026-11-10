<x-app-layout>

    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">

            <div>
                <h2 style="font-size: 26px; font-weight: 800; color: #172b4d; margin: 0;">
                    Gestión de libros
                </h2>

                <p style="font-size: 14px; color: #64748b; margin-top: 5px;">
                    Administra y organiza los libros de LibreApp.
                </p>
            </div>

            <a href="{{ route('books.create') }}"
               style="display: inline-flex; align-items: center; gap: 8px; background: #172b4d; color: #ffffff; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 800; font-size: 14px; box-shadow: 0 4px 10px rgba(23,43,77,0.15);">
                <span style="font-size: 19px;">+</span>
                Nuevo libro
            </a>

        </div>
    </x-slot>

    <div style="background: #f4f6fa; min-height: 100vh; padding: 25px 0;">

        <div style="max-width: 1450px; margin: auto;">

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div style="background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; border-left: 5px solid #16a34a; padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; font-weight: 600;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- Tarjeta principal --}}
            <div style="background: #ffffff; border-radius: 16px; padding: 25px; box-shadow: 0 5px 20px rgba(23,43,77,0.07); border: 1px solid #e2e8f0;">

                {{-- Encabezado --}}
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">

                    <div style="display: flex; align-items: center; gap: 13px;">
                        <div style="width: 45px; height: 45px; background: #edf2f8; border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 23px;">
                            📚
                        </div>

                        <div>
                            <h3 style="font-size: 20px; font-weight: 800; color: #172b4d; margin: 0;">
                                Libros registrados
                            </h3>

                            <p style="font-size: 13px; color: #94a3b8; margin-top: 5px;">
                                Listado general de libros de la biblioteca.
                            </p>
                        </div>
                    </div>

                    <div style="background: #172b4d; color: #ffffff; padding: 11px 17px; border-radius: 9px; font-size: 13px; font-weight: 800; border-bottom: 3px solid #d9a441;">
                        Total de libros: {{ $books->count() }}
                    </div>

                </div>

                {{-- Tabla --}}
                <div style="overflow-x: auto; border-radius: 10px; border: 1px solid #e2e8f0;">

                    <table style="width: 100%; border-collapse: collapse; min-width: 950px; background: #ffffff;">

                        <thead>
                        <tr style="background: #172b4d; color: #ffffff;">

                            <th style="padding: 16px 12px; text-align: left; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">ID</th>

                            <th style="padding: 16px 12px; text-align: left; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">TÍTULO</th>

                            <th style="padding: 16px 12px; text-align: left; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">ISBN</th>

                            <th style="padding: 16px 12px; text-align: left; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">AUTOR</th>

                            <th style="padding: 16px 12px; text-align: left; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">CATEGORÍA</th>

                            <th style="padding: 16px 12px; text-align: center; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">COPIAS</th>

                            <th style="padding: 16px 12px; text-align: center; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">ESTADO</th>

                            <th style="padding: 16px 12px; text-align: center; font-size: 11px; font-weight: 800; border-bottom: 3px solid #d9a441;">ACCIONES</th>

                        </tr>
                        </thead>

                        <tbody>

                        @forelse ($books as $book)

                            <tr style="border-bottom: 1px solid #e5e7eb;">

                                <td style="padding: 15px 12px; color: #64748b; font-size: 13px;">
                                    #{{ $book->id }}
                                </td>

                                <td style="padding: 15px 12px; color: #172b4d; font-weight: 800; font-size: 13px;">
                                    {{ $book->title }}
                                </td>

                                <td style="padding: 15px 12px; color: #64748b; font-size: 12px;">
                                    {{ $book->isbn }}
                                </td>

                                <td style="padding: 15px 12px; color: #475569; font-size: 13px;">
                                    {{ $book->author->name ?? 'Sin autor' }}
                                </td>

                                <td style="padding: 15px 12px; color: #475569; font-size: 13px;">
                                    {{ $book->category->name ?? 'Sin categoría' }}
                                </td>

                                <td style="padding: 15px 12px; text-align: center; color: #172b4d; font-weight: 800; font-size: 14px;">
                                    {{ $book->copies_available }}
                                </td>

                                <td style="padding: 15px 12px; text-align: center;">

                                    @if ($book->active)
                                        <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 7px 12px; border-radius: 20px; font-size: 11px; font-weight: 800;">
                                            Activo
                                        </span>
                                    @else
                                        <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 7px 12px; border-radius: 20px; font-size: 11px; font-weight: 800;">
                                            Inactivo
                                        </span>
                                    @endif

                                </td>

                                <td style="padding: 15px 12px; text-align: center; white-space: nowrap;">

                                    <a href="{{ route('books.show', $book) }}"
                                       style="display: inline-block; background: #e0eaf5; color: #172b4d; padding: 8px 11px; border-radius: 7px; text-decoration: none; font-size: 12px; font-weight: 800; margin: 2px;">
                                        Ver
                                    </a>

                                    <a href="{{ route('books.edit', $book) }}"
                                       style="display: inline-block; background: #fef3c7; color: #92400e; padding: 8px 11px; border-radius: 7px; text-decoration: none; font-size: 12px; font-weight: 800; margin: 2px;">
                                        Editar
                                    </a>

                                    <form action="{{ route('books.destroy', $book) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('¿Estás seguro de eliminar este libro?')"
                                            style="background: #fee2e2; color: #991b1b; padding: 8px 11px; border: none; border-radius: 7px; cursor: pointer; font-size: 12px; font-weight: 800; margin: 2px;">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" style="padding: 45px 20px; text-align: center;">

                                    <div style="font-size: 45px; margin-bottom: 12px;">
                                        📚
                                    </div>

                                    <p style="font-size: 17px; font-weight: 800; color: #172b4d;">
                                        No hay libros registrados
                                    </p>

                                    <p style="font-size: 13px; color: #94a3b8; margin-top: 6px;">
                                        Comienza agregando el primer libro a tu biblioteca.
                                    </p>

                                    <a href="{{ route('books.create') }}"
                                       style="display: inline-block; margin-top: 18px; background: #172b4d; color: #ffffff; padding: 12px 20px; border-radius: 9px; text-decoration: none; font-weight: 800; font-size: 13px;">
                                        + Registrar libro
                                    </a>

                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Pie --}}
            <p style="text-align: center; color: #94a3b8; font-size: 12px; margin-top: 25px;">
                LibreApp Biblioteca Virtual · Administración de libros
            </p>

        </div>

    </div>

</x-app-layout>
