
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Catálogo público
Route::get('/catalogo', [BookController::class, 'catalogIndex'])
    ->name('catalog.index');

Route::get('/catalogo/{book}', [BookController::class, 'catalogShow'])
    ->name('catalog.show');

// Panel principal
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Solicitar y consultar préstamos
    Route::get('/loans/create', [LoanController::class, 'create'])
        ->name('loans.create');

    Route::post('/loans', [LoanController::class, 'store'])
        ->name('loans.store');

    Route::get('/loans', [LoanController::class, 'index'])
        ->name('loans.index');

    Route::get('/loans/{loan}', [LoanController::class, 'show'])
        ->name('loans.show');

    // Gestión exclusiva del administrador
    Route::middleware('role:admin')->group(function () {

        Route::resource('categories', CategoryController::class);

        Route::resource('authors', AuthorController::class);

        Route::resource('books', BookController::class);

        Route::patch('/loans/{loan}/approve', [LoanController::class, 'approve'])
            ->name('loans.approve');

        Route::patch('/loans/{loan}/reject', [LoanController::class, 'reject'])
            ->name('loans.reject');

        Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])
            ->name('loans.return');
    });
});

require __DIR__.'/auth.php';
