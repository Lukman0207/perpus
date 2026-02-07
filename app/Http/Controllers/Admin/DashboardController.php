<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = User::where('role', 'siswa')->count();
        $totalTransactions = Transaction::count();
        $borrowedBooks = Transaction::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $returnedBooks = Transaction::where('status', 'dikembalikan')->count();
        $overdueBooks = Transaction::where('status', 'terlambat')->count();

        $recentTransactions = Transaction::with(['user', 'book'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalMembers',
            'totalTransactions',
            'borrowedBooks',
            'returnedBooks',
            'overdueBooks',
            'recentTransactions'
        ));
    }
}
