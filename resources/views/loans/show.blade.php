
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Detalles del préstamo
        </h2>
    </x-slot>

    <div style="padding: 30px; max-width: 750px;">

        <div style="background-color: white; padding: 25px; border: 1px solid #ddd; border-radius: 8px;">

            <h3 style="font-size: 22px; font-weight: bold; margin-bottom: 20px;">
                Préstamo #{{ $loan->id }}
            </h3>

            <p style="margin-bottom: 12px;">
                <strong>Libro:</strong>
                {{ $loan->book->title ?? 'Libro no disponible' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Lector:</strong>
                {{ $loan->user->name ?? 'Usuario no disponible' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Estado:</strong>
                {{ ucfirst($loan->status) }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Fecha de solicitud/préstamo:</strong>
                {{ $loan->loan_date ? $loan->loan_date->format('d/m/Y') : 'Pendiente de aprobación' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Fecha límite de devolución:</strong>
                {{ $loan->due_date ? $loan->due_date->format('d/m/Y') : 'No definida' }}
            </p>

            <p style="margin-bottom: 12px;">
                <strong>Fecha de devolución:</strong>
                {{ $loan->return_date ? $loan->return_date->format('d/m/Y') : 'No devuelto' }}
            </p>

            <p style="margin-bottom: 20px;">
                <strong>Observaciones:</strong>
                {{ $loan->notes ?? 'Sin observaciones' }}
            </p>

            <a href="{{ route('loans.index') }}"
               style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                Volver a préstamos
            </a>

        </div>
    </div>
</x-app-layout>
