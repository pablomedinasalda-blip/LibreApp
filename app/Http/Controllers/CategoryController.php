<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('categories.create');
    }

    // Guardar una categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    // Mostrar una categoría
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Mostrar formulario de edición
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Actualizar una categoría
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar una categoría
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
