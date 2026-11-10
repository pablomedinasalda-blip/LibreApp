<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="background: #d9a441; color: #172b4d; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                📂
            </div>

            <div>
                <h2 style="font-size: 23px; font-weight: 700; color: #172b4d; margin: 0;">
                    Registrar nueva categoría
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Agrega una categoría al catálogo de LibreApp
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 40px 20px; background: #f4f6fa; min-height: 75vh;">
        <div style="max-width: 760px; margin: 0 auto;">

            <div style="background: #ffffff; border-radius: 18px; padding: 35px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

                <div style="border-bottom: 1px solid #e5eaf1; padding-bottom: 20px; margin-bottom: 28px;">
                    <h3 style="font-size: 19px; font-weight: 700; color: #172b4d; margin: 0;">
                        Información de la categoría
                    </h3>
                    <p style="font-size: 14px; color: #64748b; margin: 7px 0 0;">
                        Completa los datos para registrar una nueva categoría.
                    </p>
                </div>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <!-- Nombre de la categoría -->
                    <div style="margin-bottom: 25px;">
                        <label for="name" style="display: block; font-weight: 600; color: #294c72; margin-bottom: 9px; font-size: 14px;">
                            Nombre de la categoría
                            <span style="color: #dc2626;">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Ejemplo: Ciencia ficción"
                            style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px; outline: none; box-sizing: border-box;"
                            required
                        >

                        @error('name')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 7px;">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div style="margin-bottom: 30px;">
                        <label for="description" style="display: block; font-weight: 600; color: #294c72; margin-bottom: 9px; font-size: 14px;">
                            Descripción
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            placeholder="Escribe una breve descripción de la categoría..."
                            style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #ffffff; color: #172b4d; font-size: 14px; outline: none; resize: vertical; box-sizing: border-box;"
                        >{{ old('description') }}</textarea>

                        @error('description')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 7px;">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; flex-wrap: wrap; border-top: 1px solid #e5eaf1; padding-top: 22px;">

                        <a
                            href="{{ route('categories.index') }}"
                            style="display: inline-block; background: #e8edf4; color: #294c72; padding: 12px 22px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 600;"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            style="background: #172b4d; color: #ffffff; padding: 12px 24px; border-radius: 9px; border: none; cursor: pointer; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
                        >
                            Guardar categoría
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
