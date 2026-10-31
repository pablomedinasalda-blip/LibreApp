
<x-app-layout>

    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Solicitar préstamo
        </h2>
    </x-slot>

    <div style="padding: 30px; max-width: 750px;">

        {{-- Mensaje de error --}}
        @if (session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div style="background-color: #dcfce7; color: #166534; padding: 12px; margin-bottom: 20px; border-radius: 6px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('loans.store') }}" method="POST">
            @csrf

            {{-- Selección del libro --}}
            <div style="margin-bottom: 20px;">

                <label for="book_id" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Selecciona el libro
                </label>

                <select id="book_id" name="book_id" required
                        style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">

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
                <p style="color: red; margin-top: 5px;">
                    {{ $message }}
                </p>
                @enderror

                @if($books->isEmpty())
                    <p style="color: #dc2626; margin-top: 8px;">
                        Actualmente no hay libros disponibles para solicitar.
                    </p>
                @endif

            </div>

            {{-- Información importante --}}
            <div style="background-color: #eff6ff; padding: 15px; border-radius: 6px; margin-bottom: 20px;">

                <p style="color: #1e40af;">
                    <strong>Información importante:</strong>
                </p>

                <ul style="padding-left: 20px; color: #1e40af;">
                    <li>Tu solicitud será revisada por un administrador.</li>
                    <li>El préstamo tendrá una duración de 15 días desde su aprobación.</li>
                    <li>Solo puedes tener un máximo de 3 préstamos activos.</li>
                </ul>

            </div>

            {{-- Observaciones --}}
            <div style="margin-bottom: 20px;">

                <label for="notes" style="display: block; margin-bottom: 8px; font-weight: bold;">
                    Observaciones (opcional)
                </label>

                <textarea id="notes" name="notes" rows="4"
                          style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('notes') }}</textarea>

                @error('notes')
                <p style="color: red; margin-top: 5px;">
                    {{ $message }}
                </p>
                @enderror

            </div>

            {{-- Botones --}}
            <button type="submit"
                    @if($books->isEmpty()) disabled @endif
                    style="background-color: #2563eb; color: white; padding: 10px 16px; border: none; border-radius: 6px; cursor: pointer; opacity: {{ $books->isEmpty() ? '0.5' : '1' }};">
                Enviar solicitud
            </button>

            <a href="{{ route('catalog.index') }}"
               style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">
                Volver al catálogo
            </a>

        </form>

    </div>

</x-app-layout>
