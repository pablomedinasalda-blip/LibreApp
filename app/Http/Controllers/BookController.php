<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Mostrar todos los libros
    public function index()
    {
        $books = Book::with(['author', 'category'])->get();

        return view('books.index', compact('books'));
    }

    // Mostrar formulario para registrar un libro
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'categories'));
    }

    // Guardar un nuevo libro
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:191',
            'isbn' => 'required|string|max:191|unique:books,isbn',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1000|max:9999',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|lte:copies_total',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'active' => 'nullable|boolean',
        ]);

        // Subir portada a Backblaze B2
        $coverPath = null;

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('portadas', 's3');

            if (!$coverPath) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'cover_image' => 'No fue posible subir la portada. Inténtalo nuevamente.',
                    ]);
            }
        }

        Book::create([
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'description' => $validated['description'] ?? null,
            'year' => $validated['year'] ?? null,
            'copies_total' => $validated['copies_total'],
            'copies_available' => $validated['copies_available'],
            'cover_image' => $coverPath,
            'active' => $request->boolean('active'),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Libro registrado correctamente.');
    }

    // Mostrar información de un libro
    public function show(Book $book)
    {
        $book->load(['author', 'category']);

        return view('books.show', compact('book'));
    }

    // Mostrar formulario para editar un libro
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    // Actualizar un libro
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:191',
            'isbn' => 'required|string|max:191|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1000|max:9999',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|lte:copies_total',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'active' => 'nullable|boolean',
        ]);

        // Conservar la portada actual si no se selecciona otra
        $coverPath = $book->cover_image;

        // Subir la nueva portada a Backblaze B2
        if ($request->hasFile('cover_image')) {
            $newCoverPath = $request->file('cover_image')->store('portadas', 's3');

            if (!$newCoverPath) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'cover_image' => 'No fue posible subir la nueva portada. Inténtalo nuevamente.',
                    ]);
            }

            $coverPath = $newCoverPath;
        }

        $oldCoverPath = $book->cover_image;

        $book->update([
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'description' => $validated['description'] ?? null,
            'year' => $validated['year'] ?? null,
            'copies_total' => $validated['copies_total'],
            'copies_available' => $validated['copies_available'],
            'cover_image' => $coverPath,
            'active' => $request->boolean('active'),
        ]);

        // Eliminar la portada anterior solamente si era un archivo de Backblaze
        if (
            $request->hasFile('cover_image') &&
            $oldCoverPath &&
            str_starts_with($oldCoverPath, 'portadas/')
        ) {
            Storage::disk('s3')->delete($oldCoverPath);
        }

        return redirect()->route('books.index')
            ->with('success', 'Libro actualizado correctamente.');
    }

    // Eliminar un libro
    public function destroy(Book $book)
    {
        if ($book->loans()->exists()) {
            return redirect()->route('books.index')
                ->with('error', 'No se puede eliminar este libro porque tiene préstamos asociados.');
        }

        // Guardar la ruta de la portada antes de eliminar el libro
        $coverPath = $book->cover_image;

        $book->delete();

        // Eliminar la portada de Backblaze si corresponde
        if ($coverPath && str_starts_with($coverPath, 'portadas/')) {
            Storage::disk('s3')->delete($coverPath);
        }

        return redirect()->route('books.index')
            ->with('success', 'Libro eliminado correctamente.');
    }

    // Mostrar catálogo público de libros
    public function catalogIndex(Request $request)
    {
        $query = Book::with(['author', 'category'])
            ->where('active', true);

        // Buscar por título o ISBN
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($authorQuery) use ($search) {
                        $authorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        return view('catalog.index', compact('books'));
    }

    // Mostrar detalles públicos de un libro
    public function catalogShow(Book $book)
    {
        abort_unless($book->active, 404);

        $book->load(['author', 'category']);

        return view('catalog.show', compact('book'));
    }
}
