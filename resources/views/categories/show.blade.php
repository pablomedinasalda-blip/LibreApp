
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la categoría
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <h3 class="text-lg font-bold mb-6">
                    Información de la categoría
                </h3>

                <!-- ID -->
                <div class="mb-4">
                    <strong>ID:</strong>
                    {{ $category->id }}
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <strong>Nombre:</strong>
                    {{ $category->name }}
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <strong>Slug:</strong>
                    {{ $category->slug }}
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <strong>Descripción:</strong>
                    {{ $category->description ?? 'Sin descripción' }}
                </div>

                <!-- Fecha de creación -->
                <div class="mb-4">
                    <strong>Fecha de creación:</strong>
                    {{ $category->created_at->format('d/m/Y H:i') }}
                </div>

                <!-- Botones -->
                <div class="flex gap-3 mt-6">
                    <a
                        href="{{ route('categories.edit', $category) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Editar
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded"
                    >
                        Volver
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
