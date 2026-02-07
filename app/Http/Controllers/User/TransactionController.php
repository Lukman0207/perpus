<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private const MAKSIMAL_PINJAM_AKTIF = 5;

    public function borrow(Request $request, Book $book)
    {
        // Batas 5 buku aktif (belum dikembalikan)
        $jumlahAktif = Transaction::where('user_id', Auth::id())
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        if ($jumlahAktif >= self::MAKSIMAL_PINJAM_AKTIF) {
            return back()->withErrors(['error' => 'Anda telah mencapai batas maksimal 5 buku yang belum dikembalikan. Kembalikan buku terlebih dahulu untuk meminjam yang baru.']);
        }

        // Validasi stok
        $borrowed = Transaction::where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        if ($book->stok - $borrowed <= 0) {
            return back()->withErrors(['error' => 'Stok buku tidak tersedia.']);
        }

        // Cek apakah user sudah meminjam buku yang sama dan belum dikembalikan
        $alreadyBorrowed = Transaction::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
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
            'tanggal_kembali' => now()->addDays(7),
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
        if (!in_array($transaction->status, ['dipinjam', 'terlambat'])) {
            return back()->withErrors(['error' => 'Buku ini sudah dikembalikan.']);
        }

        $tanggalDikembalikan = now();
        $hariTerlambat = 0;
        $denda = 0;

        if ($transaction->tanggal_kembali && $tanggalDikembalikan->gt($transaction->tanggal_kembali)) {
            $hariTerlambat = $tanggalDikembalikan->diffInDays($transaction->tanggal_kembali);
            $denda = Transaction::hitungDenda($hariTerlambat);
        }

        $transaction->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $tanggalDikembalikan,
            'type' => 'pengembalian',
            'hari_terlambat' => $hariTerlambat,
            'denda' => $denda,
        ]);

        $message = 'Buku berhasil dikembalikan.';
        if ($denda > 0) {
            $message .= ' Denda terlambat ' . $hariTerlambat . ' hari: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('user.dashboard')
            ->with('success', $message);
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
