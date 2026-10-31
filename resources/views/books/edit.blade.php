
<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px; font-weight: bold; color: #1f2937;">
            Editar libro
        </h2>
    </x-slot>

    <div style="padding: 30px; max-width: 850px;">

        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div style="margin-bottom: 18px;">
                <label for="title">Título del libro</label>
                <input type="text" id="title" name="title"
                       value="{{ old('title', $book->title) }}" required
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('title')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- ISBN -->
            <div style="margin-bottom: 18px;">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn"
                       value="{{ old('isbn', $book->isbn) }}" required
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('isbn')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Autor -->
            <div style="margin-bottom: 18px;">
                <label for="author_id">Autor</label>
                <select id="author_id" name="author_id" required
                        style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categoría -->
            <div style="margin-bottom: 18px;">
                <label for="category_id">Categoría</label>
                <select id="category_id" name="category_id" required
                        style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div style="margin-bottom: 18px;">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" rows="4"
                          style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">{{ old('description', $book->description) }}</textarea>
                @error('description')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Año -->
            <div style="margin-bottom: 18px;">
                <label for="year">Año de publicación</label>
                <input type="number" id="year" name="year"
                       value="{{ old('year', $book->year) }}" min="1000" max="9999"
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('year')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total de copias -->
            <div style="margin-bottom: 18px;">
                <label for="copies_total">Total de copias</label>
                <input type="number" id="copies_total" name="copies_total"
                       value="{{ old('copies_total', $book->copies_total) }}" min="1" required
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('copies_total')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Copias disponibles -->
            <div style="margin-bottom: 18px;">
                <label for="copies_available">Copias disponibles</label>
                <input type="number" id="copies_available" name="copies_available"
                       value="{{ old('copies_available', $book->copies_available) }}" min="0" required
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('copies_available')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Portada -->
            <div style="margin-bottom: 18px;">
                <label for="cover_image">Ruta de imagen de portada</label>
                <input type="text" id="cover_image" name="cover_image"
                       value="{{ old('cover_image', $book->cover_image) }}"
                       style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                @error('cover_image')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <!-- Estado -->
            <div style="margin-bottom: 20px;">
                <label for="active">Estado del libro</label>
                <select id="active" name="active"
                        style="display: block; width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="1" {{ old('active', $book->active ? '1' : '0') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('active', $book->active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <button type="submit"
                    style="background-color: #2563eb; color: white; padding: 10px 16px; border: none; border-radius: 6px; cursor: pointer;">
                Actualizar libro
            </button>

            <a href="{{ route('books.index') }}"
               style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; margin-left: 8px;">
                Cancelar
            </a>

        </form>
    </div>
</x-app-layout>
