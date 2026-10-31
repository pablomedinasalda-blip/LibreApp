<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'nationality' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
        ]);

        Author::create([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'bio' => $request->bio,
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Autor creado correctamente.');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'nationality' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
        ]);

        $author->update([
            'name' => $request->name,
            'nationality' => $request->nationality,
            'bio' => $request->bio,
        ]);

        return redirect()->route('authors.index')
            ->with('success', 'Autor actualizado correctamente.');
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return redirect()->route('authors.index')
                ->with('error', 'No se puede eliminar este autor porque tiene libros asociados.');
        }

        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Autor eliminado correctamente.');
    }
}
