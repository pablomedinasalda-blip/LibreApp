<x-app-layout>

    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 45px; height: 45px; background: #d9a441; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 23px;">
                📚
            </div>

            <div>
                <h2 style="font-size: 26px; font-weight: 800; color: #172b4d; margin: 0;">
                    Registrar nuevo libro
                </h2>

                <p style="font-size: 13px; color: #64748b; margin: 4px 0 0;">
                    Agrega un nuevo ejemplar al catálogo de LibreApp.
                </p>
            </div>
        </div>
    </x-slot>

    <div style="padding: 25px 0; max-width: 950px; margin: 0 auto;">

        <div style="background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 5px 20px rgba(23,43,77,0.08); border: 1px solid #e2e8f0;">

            {{-- Encabezado del formulario --}}
            <div style="background: #172b4d; padding: 22px 28px; border-bottom: 4px solid #d9a441;">
                <h3 style="color: #ffffff; font-size: 19px; font-weight: 800; margin: 0;">
                    Información del libro
                </h3>

                <p style="color: #cbd5e1; font-size: 13px; margin: 6px 0 0;">
                    Completa los datos necesarios para registrar el libro.
                </p>
            </div>

            <form action="{{ route('books.store') }}" method="POST" style="padding: 28px;">
                @csrf

                {{-- Título --}}
                <div style="margin-bottom: 20px;">
                    <label for="title" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Título del libro
                    </label>

                    <input type="text" id="title" name="title"
                           value="{{ old('title') }}" required
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('title')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ISBN --}}
                <div style="margin-bottom: 20px;">
                    <label for="isbn" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        ISBN
                    </label>

                    <input type="text" id="isbn" name="isbn"
                           value="{{ old('isbn') }}" required
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('isbn')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Autor --}}
                <div style="margin-bottom: 20px;">
                    <label for="author_id" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Autor
                    </label>

                    <select id="author_id" name="author_id" required
                            style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                        <option value="">Selecciona un autor</option>

                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('author_id')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div style="margin-bottom: 20px;">
                    <label for="category_id" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Categoría
                    </label>

                    <select id="category_id" name="category_id" required
                            style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                        <option value="">Selecciona una categoría</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div style="margin-bottom: 20px;">
                    <label for="description" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Descripción
                    </label>

                    <textarea id="description" name="description" rows="4"
                              placeholder="Escribe una breve descripción del libro..."
                              style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px; resize: vertical;">{{ old('description') }}</textarea>

                    @error('description')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Año --}}
                <div style="margin-bottom: 20px;">
                    <label for="year" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Año de publicación
                    </label>

                    <input type="number" id="year" name="year"
                           value="{{ old('year') }}" min="1000" max="9999"
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('year')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Total de copias --}}
                <div style="margin-bottom: 20px;">
                    <label for="copies_total" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Total de copias
                    </label>

                    <input type="number" id="copies_total" name="copies_total"
                           value="{{ old('copies_total', 1) }}" min="1" required
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('copies_total')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Copias disponibles --}}
                <div style="margin-bottom: 20px;">
                    <label for="copies_available" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Copias disponibles
                    </label>

                    <input type="number" id="copies_available" name="copies_available"
                           value="{{ old('copies_available', 1) }}" min="0" required
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('copies_available')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagen de portada --}}
                <div style="margin-bottom: 20px;">
                    <label for="cover_image" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Ruta de imagen de portada (opcional)
                    </label>

                    <input type="text" id="cover_image" name="cover_image"
                           value="{{ old('cover_image') }}"
                           placeholder="Ejemplo: portadas/libro.jpg"
                           style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                    @error('cover_image')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 6px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estado --}}
                <div style="margin-bottom: 25px;">
                    <label for="active" style="display: block; margin-bottom: 8px; color: #172b4d; font-weight: 800; font-size: 14px;">
                        Estado del libro
                    </label>

                    <select id="active" name="active"
                            style="display: block; width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #334155; font-size: 14px;">

                        <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>

                    </select>
                </div>

                {{-- Botones --}}
                <div style="display: flex; flex-wrap: wrap; gap: 12px; padding-top: 20px; border-top: 1px solid #e2e8f0;">

                    <button type="submit"
                            style="background: #172b4d; color: #ffffff; padding: 13px 23px; border: none; border-radius: 9px; cursor: pointer; font-size: 14px; font-weight: 800;">
                        Guardar libro
                    </button>

                    <a href="{{ route('books.index') }}"
                       style="display: inline-block; background: #e2e8f0; color: #172b4d; padding: 13px 23px; border-radius: 9px; text-decoration: none; font-size: 14px; font-weight: 800;">
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

        <p style="text-align: center; color: #94a3b8; font-size: 12px; margin-top: 18px;">
            LibreApp Biblioteca Virtual · Administración de libros
        </p>

    </div>

</x-app-layout>
