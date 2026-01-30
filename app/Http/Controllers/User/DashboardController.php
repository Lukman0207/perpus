<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $borrowedBooks = Transaction::where('user_id', $user->id)
            ->where('status', 'dipinjam')
            ->with('book')
            ->get();

        $returnedBooks = Transaction::where('user_id', $user->id)
            ->where('status', 'dikembalikan')
            ->with('book')
            ->latest()
            ->take(10)
            ->get();

        $overdueBooks = Transaction::where('user_id', $user->id)
            ->where('status', 'terlambat')
            ->with('book')
            ->get();

        return view('user.dashboard', compact('borrowedBooks', 'returnedBooks', 'overdueBooks'));
    }
}
