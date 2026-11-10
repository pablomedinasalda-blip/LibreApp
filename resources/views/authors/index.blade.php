<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #172b4d; color: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                ✍️
            </div>

            <div>
                <h2 style="font-size: 25px; font-weight: 800; color: #172b4d; margin: 0;">
                    Gestión de autores
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Administra los autores registrados en LibreApp.
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 30px; max-width: 1500px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 18px; padding: 28px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">

                <div>
                    <h3 style="font-size: 20px; font-weight: 800; color: #172b4d; margin: 0;">
                        Lista de autores
                    </h3>
                    <p style="font-size: 13px; color: #64748b; margin-top: 5px;">
                        Consulta, modifica o elimina los autores de la biblioteca.
                    </p>
                </div>

                <a href="{{ route('authors.create') }}"
                   style="display: inline-block; background: #172b4d; color: #ffffff; padding: 12px 20px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);">
                    + Nuevo autor
                </a>

            </div>

            @if (session('success'))
                <div style="background: #ecfdf5; color: #166534; border: 1px solid #bbf7d0; padding: 14px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px;">

                <table style="width: 100%; border-collapse: collapse; min-width: 750px;">

                    <thead>
                    <tr style="background: #172b4d; color: #ffffff;">

                        <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 700;">
                            ID
                        </th>

                        <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 700;">
                            Nombre
                        </th>

                        <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 700;">
                            Nacionalidad
                        </th>

                        <th style="padding: 16px; text-align: left; font-size: 13px; font-weight: 700;">
                            Biografía
                        </th>

                        <th style="padding: 16px; text-align: center; font-size: 13px; font-weight: 700;">
                            Acciones
                        </th>

                    </tr>
                    </thead>

                    <tbody>

                    @forelse ($authors as $author)

                        <tr style="border-bottom: 1px solid #e5eaf1; background: #ffffff;">

                            <td style="padding: 15px 16px; color: #64748b; font-size: 13px;">
                                #{{ $author->id }}
                            </td>

                            <td style="padding: 15px 16px; color: #172b4d; font-size: 14px; font-weight: 700;">
                                {{ $author->name }}
                            </td>

                            <td style="padding: 15px 16px; color: #475569; font-size: 14px;">
                                {{ $author->nationality ?? 'No especificada' }}
                            </td>

                            <td style="padding: 15px 16px; color: #64748b; font-size: 13px; max-width: 300px;">
                                {{ $author->bio ?? 'Sin biografía' }}
                            </td>

                            <td style="padding: 15px 16px; text-align: center; white-space: nowrap;">

                                <a href="{{ route('authors.show', $author) }}"
                                   style="display: inline-block; background: #ecfdf5; color: #15803d; padding: 8px 11px; border-radius: 7px; text-decoration: none; font-size: 12px; font-weight: 700; margin: 2px;">
                                    Ver
                                </a>

                                <a href="{{ route('authors.edit', $author) }}"
                                   style="display: inline-block; background: #eff6ff; color: #1d4ed8; padding: 8px 11px; border-radius: 7px; text-decoration: none; font-size: 12px; font-weight: 700; margin: 2px;">
                                    Editar
                                </a>

                                <form action="{{ route('authors.destroy', $author) }}"
                                      method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('¿Deseas eliminar este autor?')"
                                            style="background: #fef2f2; color: #dc2626; border: none; padding: 8px 11px; border-radius: 7px; cursor: pointer; font-size: 12px; font-weight: 700; margin: 2px;">
                                        Eliminar
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" style="text-align: center; padding: 35px 20px; color: #64748b; font-size: 14px;">
                                <div style="font-size: 32px; margin-bottom: 10px;">
                                    ✍️
                                </div>
                                Todavía no hay autores registrados.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
