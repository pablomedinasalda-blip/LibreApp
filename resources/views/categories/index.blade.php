
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de categorías
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">
                        Lista de categorías
                    </h3>

                    <a href="{{ route('categories.create') }}"
                       style="background-color: #2563eb; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                        + Nueva categoría
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-3">ID</th>
                        <th class="border p-3">Nombre</th>
                        <th class="border p-3">Slug</th>
                        <th class="border p-3">Descripción</th>
                        <th class="border p-3">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="border p-3">{{ $category->id }}</td>
                            <td class="border p-3">{{ $category->name }}</td>
                            <td class="border p-3">{{ $category->slug }}</td>
                            <td class="border p-3">{{ $category->description }}</td>

                            <td class="border p-3">
                                <a href="{{ route('categories.edit', $category) }}"
                                   class="text-blue-600">
                                    <a href="{{ route('categories.show', $category) }}"
                                       style="color: #15803d; margin-right: 10px;">
                                        Ver
                                    </a>
                                    Editar
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('¿Deseas eliminar esta categoría?')"
                                            class="text-red-600 ml-2">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                Todavía no hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
