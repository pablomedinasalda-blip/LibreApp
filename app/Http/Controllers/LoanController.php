<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanController extends Controller
{
    // Mostrar todos los préstamos
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $loans = Loan::with(['book', 'user'])
                ->latest()
                ->get();
        } else {
            $loans = Loan::with(['book', 'user'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('loans.index', compact('loans'));
    }


    // Mostrar formulario para solicitar un préstamo
    public function create(Request $request)
    {
        $books = Book::where('active', true)
            ->where('copies_available', '>', 0)
            ->orderBy('title')
            ->get();

        $selectedBook = $request->query('book_id');

        return view('loans.create', compact('books', 'selectedBook'));
    }



    // Registrar una solicitud de préstamo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();

        DB::transaction(function () use ($validated, $user) {

            // Bloquear al usuario para controlar solicitudes simultáneas
            User::whereKey($user->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Comprobar préstamos activos y vencidos
            $activeLoans = Loan::where('user_id', $user->id)
                ->whereIn('status', ['active', 'overdue'])
                ->count();

            if ($activeLoans >= 3) {
                throw ValidationException::withMessages([
                    'loan' => 'Ya tienes 3 préstamos activos. Debes devolver uno antes de solicitar otro.',
                ]);
            }

            // Bloquear el libro y comprobar su disponibilidad
            $book = Book::whereKey($validated['book_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (!$book->active || $book->copies_available < 1) {
                throw ValidationException::withMessages([
                    'book_id' => 'Este libro no está disponible actualmente.',
                ]);
            }

            // Crear solicitud pendiente
            Loan::create([
                'book_id' => $book->id,
                'user_id' => $user->id,
                'status' => 'pending',
                'due_date' => now()->addDays(15)->toDateString(),
                'notes' => $validated['notes'] ?? null,
            ]);
        });

        return redirect()->route('loans.index')
            ->with('success', 'Solicitud de préstamo enviada correctamente.');
    }


    // Mostrar detalles de un préstamo
    public function show(Loan $loan)
    {
        // Si es administrador, puede consultar cualquier préstamo.
        if (auth()->user()->role === 'admin') {
            $loan->load(['book', 'user']);

            return view('loans.show', compact('loan'));
        }

        // Si es lector, solamente puede consultar sus propios préstamos.
        if ($loan->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para consultar este préstamo.');
        }

        $loan->load(['book', 'user']);

        return view('loans.show', compact('loan'));
    }

    // Aprobar una solicitud de préstamo

// Aprobar una solicitud de préstamo
public function approve(Loan $loan)
{
    DB::transaction(function () use ($loan) {

        // Bloquear al usuario para evitar aprobaciones simultáneas
        $user = User::whereKey($loan->user_id)
            ->lockForUpdate()
            ->firstOrFail();

        // Bloquear la solicitud
        $loan = Loan::whereKey($loan->id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($loan->status !== 'pending') {
            throw ValidationException::withMessages([
                'loan' => 'Esta solicitud ya fue procesada.',
            ]);
        }

        // Comprobar que no tenga 3 préstamos sin devolver
        $activeLoans = Loan::where('user_id', $user->id)
            ->whereIn('status', ['active', 'overdue'])
            ->count();

        if ($activeLoans >= 3) {
            throw ValidationException::withMessages([
                'loan' => 'No se puede aprobar: el usuario ya tiene 3 préstamos activos.',
            ]);
        }

        // Bloquear el libro
        $book = Book::whereKey($loan->book_id)
            ->lockForUpdate()
            ->firstOrFail();

        if (!$book->active || $book->copies_available < 1) {
            throw ValidationException::withMessages([
                'book' => 'No hay ejemplares disponibles para aprobar este préstamo.',
            ]);
        }

        // Descontar un ejemplar
        $book->decrement('copies_available');

        // Activar el préstamo
        $loan->update([
            'status' => 'active',
            'loan_date' => now()->toDateString(),
            'due_date' => now()->addDays(15)->toDateString(),
        ]);
    });

    return redirect()->route('loans.index')
        ->with('success', 'Préstamo aprobado correctamente.');
}


    // Rechazar una solicitud

// Rechazar una solicitud
public function reject(Loan $loan)
{
    if ($loan->status !== 'pending') {
        return back()->with(
            'error',
            'Solo se pueden rechazar solicitudes pendientes.'
        );
    }

    $loan->update([
        'status' => 'rejected',
        'notes' => trim(($loan->notes ?? '') . ' Solicitud rechazada.'),
    ]);

    return redirect()->route('loans.index')
        ->with('success', 'Solicitud rechazada correctamente.');
}


    // Registrar devolución
    public function returnBook(Loan $loan)
    {
        DB::transaction(function () use ($loan) {
            $loan = Loan::whereKey($loan->id)->lockForUpdate()->firstOrFail();

            if ($loan->status !== 'active' && $loan->status !== 'overdue') {
                throw ValidationException::withMessages([
                    'loan' => 'Este préstamo no se encuentra activo.',
                ]);
            }

            $book = Book::whereKey($loan->book_id)
                ->lockForUpdate()
                ->firstOrFail();

            $loan->update([
                'status' => 'returned',
                'return_date' => now()->toDateString(),
            ]);

            $book->increment('copies_available');
        });

        return redirect()->route('loans.index')
            ->with('success', 'Libro devuelto correctamente.');
    }
}
