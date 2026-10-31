
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar nueva categoría
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <!-- Nombre de la categoría -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700">
                            Nombre de la categoría
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                        >

                        @error('name')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">
                            Descripción
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('description') }}</textarea>

                        @error('description')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center gap-3">
                        <button
                            type="submit"
                            style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; border: none; cursor: pointer;"
                        >
                            Guardar categoría
                        </button>

                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded"
                        >
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
