
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del autor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h3 class="text-lg font-bold mb-6">
                    Información del autor
                </h3>

                <!-- ID -->
                <div class="mb-4">
                    <strong>ID:</strong>
                    {{ $author->id }}
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <strong>Nombre:</strong>
                    {{ $author->name }}
                </div>

                <!-- Nacionalidad -->
                <div class="mb-4">
                    <strong>Nacionalidad:</strong>
                    {{ $author->nationality ?? 'No especificada' }}
                </div>

                <!-- Biografía -->
                <div class="mb-4">
                    <strong>Biografía:</strong>
                    <p class="mt-2">
                        {{ $author->bio ?? 'Sin biografía registrada' }}
                    </p>
                </div>

                <!-- Fecha de creación -->
                <div class="mb-4">
                    <strong>Fecha de creación:</strong>
                    {{ $author->created_at->format('d/m/Y H:i') }}
                </div>

                <!-- Botones -->
                <div class="flex gap-3 mt-6">

                    <a
                        href="{{ route('authors.edit', $author) }}"
                        style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;"
                    >
                        Editar autor
                    </a>

                    <a
                        href="{{ route('authors.index') }}"
                        style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;"
                    >
                        Volver
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
