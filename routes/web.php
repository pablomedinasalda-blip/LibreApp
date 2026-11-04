<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Catálogo público
|--------------------------------------------------------------------------
*/

Route::get('/catalogo', [BookController::class, 'catalogIndex'])
    ->name('catalog.index');

Route::get('/catalogo/{book}', [BookController::class, 'catalogShow'])
    ->name('catalog.show');

/*
|--------------------------------------------------------------------------
| Panel de usuario
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Préstamos
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/mis-prestamos', [LoanController::class, 'index'])
        ->name('loans.index');

    Route::post('/prestamos/{book}', [LoanController::class, 'store'])
        ->name('loans.store');

});

/*
|--------------------------------------------------------------------------
| Administración
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('categorias', CategoryController::class)
        ->names('categories');

    Route::resource('autores', AuthorController::class)
        ->names('authors');

    Route::resource('libros', BookController::class)
        ->names('books');

    Route::patch('/prestamos/{loan}/aprobar', [LoanController::class, 'approve'])
        ->name('loans.approve');

    Route::patch('/prestamos/{loan}/rechazar', [LoanController::class, 'reject'])
        ->name('loans.reject');

    Route::patch('/prestamos/{loan}/devolver', [LoanController::class, 'return'])
        ->name('loans.return');

});

/*
|--------------------------------------------------------------------------
| Diagnóstico temporal de sesiones
|--------------------------------------------------------------------------
*/

Route::get('/diagnostico-sesion', function (Request $request) {

    $request->session()->put('prueba_sesion', 'funciona');

    return response()->json([
        'entorno' => app()->environment(),
        'controlador_sesion' => config('session.driver'),
        'dominio_cookie' => config('session.domain'),
        'cookie_segura' => config('session.secure'),
        'same_site' => config('session.same_site'),
        'sesion_iniciada' => $request->hasSession(),
        'sesion_guardada' => $request->session()->get('prueba_sesion') === 'funciona',
    ]);

});

/*
|--------------------------------------------------------------------------
| Autenticación Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
