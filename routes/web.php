<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

    Route::get('/prestamos/solicitar', [LoanController::class, 'create'])
        ->name('loans.create');

    Route::post('/prestamos', [LoanController::class, 'store'])
        ->name('loans.store');

    Route::get('/prestamos/{loan}', [LoanController::class, 'show'])
        ->name('loans.show');

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

    Route::patch('/prestamos/{loan}/devolver', [LoanController::class, 'returnBook'])
        ->name('loans.return');

});

/*
|--------------------------------------------------------------------------
| Diagnóstico temporal de sesiones
|--------------------------------------------------------------------------
*/

Route::get('/diagnostico-sesion', function (Request $request) {
    $session = $request->session();

    $session->put('prueba_sesion', 'funciona');

    return response()->json([
        'entorno' => app()->environment(),
        'controlador_sesion' => config('session.driver'),
        'dominio_cookie' => config('session.domain'),
        'cookie_segura' => config('session.secure'),
        'same_site' => config('session.same_site'),
        'sesion_iniciada' => $session->isStarted(),
        'sesion_guardada' => $session->get('prueba_sesion') === 'funciona',
        'id_sesion' => $session->getId(),
        'cookie_configurada' => config('session.cookie'),
    ]);
});

/*
|--------------------------------------------------------------------------
| Autenticación Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
