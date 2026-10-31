<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:191',
            'isbn' => 'required|string|max:191|unique:books,isbn',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1000|max:9999',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|lte:copies_total',
            'cover_image' => 'nullable|string|max:191',
            'active' => 'nullable|boolean',
        ]);

        Book::create([
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'title' => $request->title,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'year' => $request->year,
            'copies_total' => $request->copies_total,
            'copies_available' => $request->copies_available,
            'cover_image' => $request->cover_image,
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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|max:191',
            'isbn' => 'required|string|max:191|unique:books,isbn,' . $book->id,
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1000|max:9999',
            'copies_total' => 'required|integer|min:1',
            'copies_available' => 'required|integer|min:0|lte:copies_total',
            'cover_image' => 'nullable|string|max:191',
            'active' => 'nullable|boolean',
        ]);

        $book->update([
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'title' => $request->title,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'year' => $request->year,
            'copies_total' => $request->copies_total,
            'copies_available' => $request->copies_available,
            'cover_image' => $request->cover_image,
            'active' => $request->boolean('active'),
        ]);

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

        $book->delete();

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
