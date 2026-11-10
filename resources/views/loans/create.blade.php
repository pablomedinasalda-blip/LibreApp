```blade
<x-app-layout>

    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 23px;">
                📖
            </div>
            <div>
                <h2 style="font-size: 26px; font-weight: 800; color: #172b4d; margin: 0;">
                    Solicitar préstamo
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Completa los datos para solicitar un libro de nuestra biblioteca
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 25px 0; max-width: 850px; margin: 0 auto;">

        {{-- Mensaje de error --}}
        @if (session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 15px 18px; margin-bottom: 20px; border-radius: 10px; border-left: 5px solid #dc2626; font-weight: 600;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 15px 18px; margin-bottom: 20px; border-radius: 10px; border-left: 5px solid #16a34a; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario --}}
        <div style="background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 5px 20px rgba(23,43,77,0.08); border: 1px solid #e2e8f0;">

            <div style="background: #172b4d; padding: 22px 28px; border-bottom: 4px solid #d9a441;">
                <h3 style="color: #ffffff; font-size: 19px; font-weight: 800; margin: 0;">
                    Datos de la solicitud
                </h3>
                <p style="color: #cbd5e1; font-size: 13px; margin: 6px 0 0;">
                    Selecciona el libro y agrega tus observaciones.
                </p>
            </div>

            <form action="{{ route('loans.store') }}" method="POST" style="padding: 28px;">
                @csrf

                {{-- Selección del libro --}}
                <div style="margin-bottom: 25px;">

                    <label for="book_id" style="display: block; margin-bottom: 9px; font-weight: 800; color: #172b4d; font-size: 14px;">
                        Selecciona el libro
                        <span style="color: #dc2626;">*</span>
                    </label>

                    <select id="book_id" name="book_id" required
                            style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px; outline-color: #294c72;">

                        <option value="">Selecciona un libro</option>

                        @foreach ($books as $book)

                            <option value="{{ $book->id }}"
                                {{ old('book_id', $selectedBook) == $book->id ? 'selected' : '' }}>

                                {{ $book->title }} -
                                {{ $book->copies_available }} copias disponibles

                            </option>

                        @endforeach

                    </select>

                    @error('book_id')
                    <p style="color: #dc2626; margin-top: 7px; font-size: 13px;">
                        {{ $message }}
                    </p>
                    @enderror

                    @if($books->isEmpty())
                        <p style="color: #dc2626; margin-top: 9px; font-size: 13px; font-weight: 600;">
                            Actualmente no hay libros disponibles para solicitar.
                        </p>
                    @endif

                </div>

                {{-- Información importante --}}
                <div style="background: #eff6ff; padding: 20px; border-radius: 11px; margin-bottom: 25px; border-left: 5px solid #294c72;">

                    <p style="color: #172b4d; font-weight: 800; margin-bottom: 12px; font-size: 14px;">
                        <span style="color: #d9a441; margin-right: 5px;">●</span>
                        Información importante
                    </p>

                    <ul style="padding-left: 22px; color: #294c72; font-size: 13px; line-height: 2;">
                        <li>Tu solicitud será revisada por un administrador.</li>
                        <li>El préstamo tendrá una duración de 15 días desde su aprobación.</li>
                        <li>Solo puedes tener un máximo de 3 préstamos activos.</li>
                    </ul>

                </div>

                {{-- Observaciones --}}
                <div style="margin-bottom: 28px;">

                    <label for="notes" style="display: block; margin-bottom: 9px; font-weight: 800; color: #172b4d; font-size: 14px;">
                        Observaciones (opcional)
                    </label>

                    <textarea id="notes" name="notes" rows="4"
                              placeholder="Escribe aquí alguna observación sobre tu solicitud..."
                              style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px; resize: vertical; outline-color: #294c72;">{{ old('notes') }}</textarea>

                    @error('notes')
                    <p style="color: #dc2626; margin-top: 7px; font-size: 13px;">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Botones --}}
                <div style="display: flex; flex-wrap: wrap; gap: 12px; padding-top: 20px; border-top: 1px solid #e2e8f0;">

                    <button type="submit"
                            @if($books->isEmpty()) disabled @endif
                            style="background: #172b4d; color: #ffffff; padding: 13px 22px; border: none; border-radius: 9px; cursor: pointer; font-size: 14px; font-weight: 800; opacity: {{ $books->isEmpty() ? '0.5' : '1' }};">
                        Enviar solicitud
                    </button>

                    <a href="{{ route('catalog.index') }}"
                       style="display: inline-block; background: #e2e8f0; color: #172b4d; padding: 13px 22px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 800;">
                        Volver al catálogo
                    </a>

                </div>

            </form>
        </div>

        <p style="text-align: center; color: #94a3b8; font-size: 12px; margin-top: 18px;">
            LibreApp Biblioteca Virtual · Sistema de gestión de préstamos
        </p>

    </div>

</x-app-layout>
```
