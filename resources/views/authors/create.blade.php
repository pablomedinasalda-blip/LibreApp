
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar nuevo autor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('authors.store') }}" method="POST">
                    @csrf

                    <!-- Nombre del autor -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700">
                            Nombre del autor
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

                    <!-- Nacionalidad -->
                    <div class="mb-4">
                        <label for="nationality" class="block font-medium text-gray-700">
                            Nacionalidad
                        </label>

                        <input
                            type="text"
                            name="nationality"
                            id="nationality"
                            value="{{ old('nationality') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >

                        @error('nationality')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Biografía -->
                    <div class="mb-4">
                        <label for="bio" class="block font-medium text-gray-700">
                            Biografía
                        </label>

                        <textarea
                            name="bio"
                            id="bio"
                            rows="5"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                        >{{ old('bio') }}</textarea>

                        @error('bio')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center gap-3">

                        <button
                            type="submit"
                            style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; border: none; cursor: pointer;"
                        >
                            Guardar autor
                        </button>

                        <a
                            href="{{ route('authors.index') }}"
                            style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;"
                        >
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
