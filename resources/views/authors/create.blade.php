<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #172b4d; color: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                ✍️
            </div>

            <div>
                <h2 style="font-size: 25px; font-weight: 800; color: #172b4d; margin: 0;">
                    Registrar nuevo autor
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Agrega un nuevo autor al catálogo de LibreApp.
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 30px; max-width: 950px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 18px; padding: 32px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

            <div style="border-bottom: 2px solid #f0f2f5; padding-bottom: 18px; margin-bottom: 25px;">
                <h3 style="font-size: 19px; font-weight: 800; color: #172b4d; margin: 0;">
                    Información del autor
                </h3>
                <p style="font-size: 13px; color: #64748b; margin-top: 6px;">
                    Completa los siguientes campos para registrar al autor.
                </p>
            </div>

            <form action="{{ route('authors.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 22px;">
                    <label for="name" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Nombre del autor
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                        style="display: block; width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;"
                    >

                    @error('name')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 7px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 22px;">
                    <label for="nationality" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Nacionalidad
                    </label>

                    <input
                        type="text"
                        name="nationality"
                        id="nationality"
                        value="{{ old('nationality') }}"
                        style="display: block; width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;"
                    >

                    @error('nationality')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 7px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="bio" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Biografía
                    </label>

                    <textarea
                        name="bio"
                        id="bio"
                        rows="6"
                        style="display: block; width: 100%; box-sizing: border-box; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d; resize: vertical;"
                    >{{ old('bio') }}</textarea>

                    @error('bio')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 7px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 12px; border-top: 1px solid #e5eaf1; padding-top: 22px;">

                    <button
                        type="submit"
                        style="background: #172b4d; color: #ffffff; padding: 13px 23px; border: none; border-radius: 9px; cursor: pointer; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);"
                    >
                        Guardar autor
                    </button>

                    <a
                        href="{{ route('authors.index') }}"
                        style="background: #e8edf4; color: #172b4d; padding: 13px 23px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 700;"
                    >
                        Cancelar
                    </a>

                </div>

            </form>
        </div>
    </div>
</x-app-layout>
