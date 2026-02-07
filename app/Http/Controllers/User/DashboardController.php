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
            ->whereIn('status', ['dipinjam', 'terlambat'])
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

        // Total denda dari transaksi yang sudah dikembalikan tapi ada denda
        $transaksiDenganDenda = Transaction::where('user_id', $user->id)
            ->whereIn('status', ['dikembalikan', 'terlambat'])
            ->get();
        $totalDenda = $transaksiDenganDenda->sum(fn ($t) => (float) $t->display_denda);

        // Untuk buku terlambat (belum dikembalikan): estimasi hari terlambat & denda jika dikembalikan hari ini
        $overdueWithEstimate = $overdueBooks->map(function ($t) {
            $hariTerlambat = (int) now()->diffInDays($t->tanggal_kembali);
            $dendaEstimasi = Transaction::hitungDenda($hariTerlambat);
            return (object) [
                'transaction' => $t,
                'hari_terlambat' => $hariTerlambat,
                'denda_estimasi' => $dendaEstimasi,
            ];
        });

        return view('user.dashboard', compact('borrowedBooks', 'returnedBooks', 'overdueBooks', 'totalDenda', 'overdueWithEstimate'));
    }
}
