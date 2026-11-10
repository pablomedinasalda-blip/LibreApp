<x-app-layout>

    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 23px;">
                📋
            </div>
            <div>
                <h2 style="font-size: 26px; font-weight: 800; color: #172b4d; margin: 0;">
                    Detalles del préstamo
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Consulta toda la información del préstamo seleccionado
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 25px 0; max-width: 850px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 5px 20px rgba(23,43,77,0.08); border: 1px solid #e2e8f0;">

            {{-- Encabezado de la tarjeta --}}
            <div style="background: #172b4d; padding: 24px 28px; border-bottom: 4px solid #d9a441;">
                <p style="color: #cbd5e1; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 7px;">
                    Registro de préstamo
                </p>
                <h3 style="font-size: 25px; font-weight: 800; color: #ffffff; margin: 0;">
                    Préstamo #{{ $loan->id }}
                </h3>
            </div>

            {{-- Información del préstamo --}}
            <div style="padding: 28px;">

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px;">

                    {{-- Libro --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px;">
                            Libro
                        </p>
                        <p style="color: #172b4d; font-size: 16px; font-weight: 700; margin: 0;">
                            {{ $loan->book->title ?? 'Libro no disponible' }}
                        </p>
                    </div>

                    {{-- Lector --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px;">
                            Lector
                        </p>
                        <p style="color: #172b4d; font-size: 16px; font-weight: 700; margin: 0;">
                            {{ $loan->user->name ?? 'Usuario no disponible' }}
                        </p>
                    </div>

                    {{-- Estado --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 10px;">
                            Estado del préstamo
                        </p>

                        @switch($loan->status)
                            @case('pending')
                                <span style="display: inline-block; background: #fef3c7; color: #92400e; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">Pendiente</span>
                                @break

                            @case('active')
                                <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">Activo</span>
                                @break

                            @case('returned')
                                <span style="display: inline-block; background: #dcfce7; color: #166534; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">Devuelto</span>
                                @break

                            @case('overdue')
                                <span style="display: inline-block; background: #fee2e2; color: #991b1b; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">Vencido</span>
                                @break

                            @case('rejected')
                                <span style="display: inline-block; background: #f1f5f9; color: #475569; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">Rechazado</span>
                                @break

                            @default
                                <span style="display: inline-block; background: #e2e8f0; color: #334155; padding: 7px 13px; border-radius: 20px; font-size: 12px; font-weight: 800;">
                                    {{ ucfirst($loan->status) }}
                                </span>
                        @endswitch
                    </div>

                    {{-- Fecha de solicitud --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px;">
                            Fecha de solicitud / préstamo
                        </p>
                        <p style="color: #172b4d; font-size: 15px; font-weight: 700; margin: 0;">
                            {{ $loan->loan_date ? $loan->loan_date->format('d/m/Y') : 'Pendiente de aprobación' }}
                        </p>
                    </div>

                    {{-- Fecha límite --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px;">
                            Fecha límite de devolución
                        </p>
                        <p style="color: #172b4d; font-size: 15px; font-weight: 700; margin: 0;">
                            {{ $loan->due_date ? $loan->due_date->format('d/m/Y') : 'No definida' }}
                        </p>
                    </div>

                    {{-- Fecha de devolución --}}
                    <div style="background: #f8fafc; padding: 18px; border-radius: 11px; border: 1px solid #e2e8f0;">
                        <p style="color: #64748b; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 8px;">
                            Fecha de devolución
                        </p>
                        <p style="color: #172b4d; font-size: 15px; font-weight: 700; margin: 0;">
                            {{ $loan->return_date ? $loan->return_date->format('d/m/Y') : 'No devuelto' }}
                        </p>
                    </div>

                </div>

                {{-- Observaciones --}}
                <div style="margin-top: 22px; background: #fffbeb; border: 1px solid #f3dfae; border-left: 5px solid #d9a441; padding: 20px; border-radius: 10px;">

                    <p style="color: #92400e; font-size: 12px; font-weight: 800; text-transform: uppercase; margin: 0 0 9px;">
                        Observaciones
                    </p>

                    <p style="color: #78350f; font-size: 14px; line-height: 1.7; margin: 0;">
                        {{ $loan->notes ?? 'Sin observaciones' }}
                    </p>

                </div>

                {{-- Botón de regreso --}}
                <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid #e2e8f0;">

                    <a href="{{ route('loans.index') }}"
                       style="display: inline-block; background: #172b4d; color: #ffffff; padding: 12px 20px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 800;">
                        ← Volver a préstamos
                    </a>

                </div>

            </div>
        </div>

    </div>

</x-app-layout>
