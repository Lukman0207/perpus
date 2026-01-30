<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function borrow(Request $request, Book $book)
    {
        // Validasi stok
        $borrowed = Transaction::where('book_id', $book->id)
            ->where('type', 'peminjaman')
            ->where('status', 'dipinjam')
            ->count();

        if ($book->stok - $borrowed <= 0) {
            return back()->withErrors(['error' => 'Stok buku tidak tersedia.']);
        }

        // Cek apakah user sudah meminjam buku yang sama dan belum dikembalikan
        $alreadyBorrowed = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('type', 'peminjaman')
            ->where('status', 'dipinjam')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->withErrors(['error' => 'Anda sudah meminjam buku ini.']);
        }

        // Buat transaksi peminjaman
        Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'type' => 'peminjaman',
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7), // Pinjam selama 7 hari
            'status' => 'dipinjam',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Buku berhasil dipinjam. Tanggal kembali: ' . now()->addDays(7)->format('d/m/Y'));
    }

    public function return(Transaction $transaction)
    {
        // Pastikan transaction milik user yang login
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        // Pastikan status masih dipinjam
        if ($transaction->status !== 'dipinjam') {
            return back()->withErrors(['error' => 'Buku ini sudah dikembalikan.']);
        }

        // Update status menjadi dikembalikan
        $transaction->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now(),
            'type' => 'pengembalian',
        ]);

        // Cek apakah terlambat
        if ($transaction->tanggal_kembali < now()) {
            $transaction->update(['status' => 'terlambat']);
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Buku berhasil dikembalikan.');
    }

    public function myTransactions()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('book')
            ->latest()
            ->paginate(15);

        return view('user.transactions.index', compact('transactions'));
    }
}
