<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Estadísticas para el administrador
        if ($user->role === 'admin') {

            $totalUsers = User::count();
            $totalBooks = Book::count();
            $totalAuthors = Author::count();
            $totalCategories = Category::count();

            $activeLoans = Loan::where('status', 'active')->count();

            $pendingLoans = Loan::where('status', 'pending')->count();

            $overdueLoans = Loan::whereIn('status', ['active', 'overdue'])
                ->whereDate('due_date', '<', today())
                ->count();

            return view('dashboard', compact(
                'totalUsers',
                'totalBooks',
                'totalAuthors',
                'totalCategories',
                'activeLoans',
                'pendingLoans',
                'overdueLoans'
            ));
        }

        // Estadísticas para el lector
        $myLoans = Loan::where('user_id', $user->id);

        $myActiveLoans = (clone $myLoans)
            ->where('status', 'active')
            ->count();

        $myPendingLoans = (clone $myLoans)
            ->where('status', 'pending')
            ->count();

        $myReturnedLoans = (clone $myLoans)
            ->where('status', 'returned')
            ->count();

        $myOverdueLoans = (clone $myLoans)
            ->whereIn('status', ['active', 'overdue'])
            ->whereDate('due_date', '<', today())
            ->count();

        return view('dashboard', compact(
            'myActiveLoans',
            'myPendingLoans',
            'myReturnedLoans',
            'myOverdueLoans'
        ));
    }
}
