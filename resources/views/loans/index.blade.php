<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #172b4d; font-size: 23px;">
                📚
            </div>
            <div>
                <h2 style="font-size: 26px; font-weight: 800; color: #172b4d; margin: 0;">
                    Gestión de préstamos
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Administración y seguimiento de préstamos de libros
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 25px 0;">

        {{-- Botón para solicitar préstamo --}}
        <div style="display: flex; justify-content: flex-end; margin-bottom: 25px;">
            <a href="{{ route('loans.create') }}"
               style="display: inline-flex; align-items: center; gap: 8px; background: #172b4d; color: #ffffff; padding: 12px 20px; border-radius: 9px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 10px rgba(23,43,77,0.18);">
                <span style="font-size: 18px;">+</span>
                Solicitar préstamo
            </a>
        </div>

        {{-- Mensajes del sistema --}}
        @if (session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 15px 18px; margin-bottom: 20px; border-radius: 10px; border-left: 5px solid #16a34a; font-weight: 600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 15px 18px; margin-bottom: 20px; border-radius: 10px; border-left: 5px solid #dc2626; font-weight: 600;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabla de préstamos --}}
        <div style="background: #ffffff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(23,43,77,0.07); border: 1px solid #e2e8f0;">

            <div style="background: #172b4d; padding: 20px 24px; border-bottom: 4px solid #d9a441;">
                <h3 style="color: #ffffff; font-size: 17px; font-weight: 800; margin: 0;">
                    Registro de préstamos
                </h3>
                <p style="color: #cbd5e1; font-size: 13px; margin: 5px 0 0;">
                    Consulta los préstamos y administra sus estados.
                </p>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: #ffffff; min-width: 850px;">

                    <thead>
                    <tr style="background: #f1f5f9; color: #172b4d;">
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: center; font-size: 12px; font-weight: 800;">ID</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: left; font-size: 12px; font-weight: 800;">LIBRO</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: left; font-size: 12px; font-weight: 800;">LECTOR</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: center; font-size: 12px; font-weight: 800;">ESTADO</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: center; font-size: 12px; font-weight: 800;">FECHA PRÉSTAMO</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: center; font-size: 12px; font-weight: 800;">FECHA LÍMITE</th>
                        <th style="padding: 16px 12px; border-bottom: 2px solid #d9a441; text-align: center; font-size: 12px; font-weight: 800;">ACCIONES</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($loans as $loan)
                        <tr style="border-bottom: 1px solid #e2e8f0;">

                            <td style="padding: 15px 12px; text-align: center; color: #64748b; font-weight: 700;">
                                #{{ $loan->id }}
                            </td>

                            <td style="padding: 15px 12px; color: #172b4d; font-weight: 700;">
                                {{ $loan->book->title ?? 'Libro no disponible' }}
                            </td>

                            <td style="padding: 15px 12px; color: #475569;">
                                {{ $loan->user->name ?? 'Usuario no disponible' }}
                            </td>

                            <td style="padding: 15px 12px; text-align: center;">
                                @switch($loan->status)
                                    @case('pending')
                                        <span style="display: inline-block; background: #fef3c7; color: #92400e; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800;">Pendiente</span>
                                        @break

                                    @case('active')
                                        <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800;">Activo</span>
                                        @break

                                    @case('returned')
                                        <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800;">Devuelto</span>
                                        @break

                                    @case('overdue')
                                        <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800;">Vencido</span>
                                        @break

                                    @case('rejected')
                                        <span style="display: inline-block; background: #f1f5f9; color: #475569; padding: 6px 11px; border-radius: 20px; font-size: 11px; font-weight: 800;">Rechazado</span>
                                        @break

                                    @default
                                        {{ ucfirst($loan->status) }}
                                @endswitch
                            </td>

                            <td style="padding: 15px 12px; text-align: center; color: #475569; font-size: 13px;">
                                {{ $loan->loan_date ? $loan->loan_date->format('d/m/Y') : 'Pendiente' }}
                            </td>

                            <td style="padding: 15px 12px; text-align: center; color: #475569; font-size: 13px;">
                                {{ $loan->due_date ? $loan->due_date->format('d/m/Y') : 'No definida' }}
                            </td>

                            <td style="padding: 15px 12px; text-align: center; white-space: nowrap;">

                                <a href="{{ route('loans.show', $loan) }}"
                                   style="display: inline-block; background: #e0eaf5; color: #172b4d; padding: 7px 11px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 800; margin: 2px;">
                                    Ver
                                </a>

                                @if ($loan->status === 'pending')
                                    <form action="{{ route('loans.approve', $loan) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                style="background: #166534; color: #ffffff; padding: 7px 10px; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 700; margin: 2px;">
                                            Aprobar
                                        </button>
                                    </form>

                                    <form action="{{ route('loans.reject', $loan) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                style="background: #b91c1c; color: #ffffff; padding: 7px 10px; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 700; margin: 2px;">
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
                                                style="background: #294c72; color: #ffffff; padding: 7px 10px; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 700; margin: 2px;">
                                            Devolver
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                style="padding: 35px 20px; text-align: center; color: #64748b; font-size: 14px;">
                                <div style="font-size: 35px; margin-bottom: 10px;">📚</div>
                                <strong style="color: #172b4d;">No hay préstamos registrados.</strong>
                                <p style="margin-top: 5px;">Cuando existan préstamos, aparecerán en esta tabla.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
