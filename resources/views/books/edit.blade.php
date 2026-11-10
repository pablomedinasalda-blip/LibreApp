<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #172b4d; color: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;">

            </div>

            <div>
                <h2 style="font-size: 25px; font-weight: 800; color: #172b4d; margin: 0;">
                    Editar libro
                </h2>
                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Modifica la información del libro seleccionado.
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 30px; max-width: 950px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 18px; padding: 32px; box-shadow: 0 8px 25px rgba(23, 43, 77, 0.08); border: 1px solid #e5eaf1;">

            <div style="border-bottom: 2px solid #f0f2f5; padding-bottom: 18px; margin-bottom: 25px;">
                <h3 style="font-size: 19px; font-weight: 800; color: #172b4d; margin: 0;">
                    Información del libro
                </h3>
                <p style="font-size: 13px; color: #64748b; margin-top: 6px;">
                    Actualiza los datos necesarios y guarda los cambios.
                </p>
            </div>

            <form action="{{ route('books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label for="title" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Título del libro
                    </label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $book->title) }}" required
                           style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d; outline: none;">
                    @error('title')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="isbn" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        ISBN
                    </label>
                    <input type="text" id="isbn" name="isbn"
                           value="{{ old('isbn', $book->isbn) }}" required
                           style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d; outline: none;">
                    @error('isbn')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="author_id" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Autor
                    </label>
                    <select id="author_id" name="author_id" required
                            style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="category_id" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Categoría
                    </label>
                    <select id="category_id" name="category_id" required
                            style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="description" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Descripción
                    </label>
                    <textarea id="description" name="description" rows="4"
                              style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d; resize: vertical;">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">

                    <div style="margin-bottom: 5px;">
                        <label for="year" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                            Año de publicación
                        </label>
                        <input type="number" id="year" name="year"
                               value="{{ old('year', $book->year) }}" min="1000" max="9999"
                               style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        @error('year')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 5px;">
                        <label for="copies_total" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                            Total de copias
                        </label>
                        <input type="number" id="copies_total" name="copies_total"
                               value="{{ old('copies_total', $book->copies_total) }}" min="1" required
                               style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        @error('copies_total')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 5px;">
                        <label for="copies_available" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                            Copias disponibles
                        </label>
                        <input type="number" id="copies_available" name="copies_available"
                               value="{{ old('copies_available', $book->copies_available) }}" min="0" required
                               style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        @error('copies_available')
                        <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div style="margin-top: 20px; margin-bottom: 20px;">
                    <label for="cover_image" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Ruta de imagen de portada
                    </label>
                    <input type="text" id="cover_image" name="cover_image"
                           value="{{ old('cover_image', $book->cover_image) }}"
                           style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                    @error('cover_image')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 25px;">
                    <label for="active" style="display: block; font-size: 14px; font-weight: 700; color: #172b4d; margin-bottom: 8px;">
                        Estado del libro
                    </label>
                    <select id="active" name="active"
                            style="display: block; width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #172b4d;">
                        <option value="1" {{ old('active', $book->active ? '1' : '0') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('active', $book->active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 12px; border-top: 1px solid #e5eaf1; padding-top: 22px;">

                    <button type="submit"
                            style="background: #172b4d; color: #ffffff; padding: 13px 23px; border: none; border-radius: 9px; cursor: pointer; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(23, 43, 77, 0.18);">
                        Actualizar libro
                    </button>

                    <a href="{{ route('books.index') }}"
                       style="background: #e8edf4; color: #172b4d; padding: 13px 23px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 700;">
                        Cancelar
                    </a>

                </div>

            </form>
        </div>
    </div>
</x-app-layout>
