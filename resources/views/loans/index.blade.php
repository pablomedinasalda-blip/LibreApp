
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Gestión de préstamos
        </h2>
    </x-slot>

    <div style="padding: 30px;">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('loans.create') }}"
               style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                + Solicitar préstamo
            </a>
        </div>

        @if (session('success'))
            <div style="background-color: #dcfce7; color: #166534; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background-color: white;">
                <thead>
                <tr style="background-color: #e5e7eb;">
                    <th style="padding: 12px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Libro</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Lector</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Estado</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Fecha préstamo</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Fecha límite</th>
                    <th style="padding: 12px; border: 1px solid #ddd;">Acciones</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $loan->id }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $loan->book->title ?? 'Libro no disponible' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $loan->user->name ?? 'Usuario no disponible' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            @switch($loan->status)
                                @case('pending')
                                    Pendiente
                                    @break

                                @case('active')
                                    Activo
                                    @break

                                @case('returned')
                                    Devuelto
                                    @break

                                @case('overdue')
                                    Vencido
                                    @break

                                @case('rejected')
                                    Rechazado
                                    @break

                                @default
                                    {{ ucfirst($loan->status) }}
                            @endswitch
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $loan->loan_date ? $loan->loan_date->format('d/m/Y') : 'Pendiente' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $loan->due_date ? $loan->due_date->format('d/m/Y') : 'No definida' }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; white-space: nowrap;">

                            <a href="{{ route('loans.show', $loan) }}"
                               style="color: #15803d; margin-right: 8px;">
                                Ver
                            </a>

                            @if ($loan->status === 'pending')
                                <form action="{{ route('loans.approve', $loan) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            style="background-color: #16a34a; color: white; padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer;">
                                        Aprobar
                                    </button>
                                </form>

                                <form action="{{ route('loans.reject', $loan) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            style="background-color: #dc2626; color: white; padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer;">
                                        Rechazar
                                    </button>
                                </form>
                            @endif

                            @if (in_array($loan->status, ['active', 'overdue']))
                                <form action="{{ route('loans.return', $loan) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            style="background-color: #2563eb; color: white; padding: 6px 10px; border: none; border-radius: 4px; cursor: pointer;">
                                        Devolver
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7"
                            style="padding: 20px; text-align: center; border: 1px solid #ddd;">
                            No hay préstamos registrados.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
