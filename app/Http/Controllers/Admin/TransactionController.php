<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'book']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        $transactions = $query->latest()->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = User::where('role', 'siswa')->get();
        $books = Book::all();
        return view('admin.transactions.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        $borrowed = Transaction::where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        if ($book->stok - $borrowed <= 0) {
            return back()->withErrors(['book_id' => 'Stok buku tidak tersedia.'])->withInput();
        }

        $validated['type'] = 'peminjaman';
        $validated['status'] = 'dipinjam';

        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'book']);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $members = User::where('role', 'siswa')->get();
        $books = Book::all();
        return view('admin.transactions.edit', compact('transaction', 'members', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',
            'tanggal_dikembalikan' => 'nullable|date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'keterangan' => 'nullable|string',
        ]);

        if ($validated['status'] === 'dikembalikan' && !($validated['tanggal_dikembalikan'] ?? null)) {
            $validated['tanggal_dikembalikan'] = now();
        }

        $hariTerlambat = 0;
        $denda = 0;
        if (($validated['status'] ?? '') === 'dikembalikan' && !empty($validated['tanggal_dikembalikan'])) {
            $tanggalDikembalikan = \Carbon\Carbon::parse($validated['tanggal_dikembalikan']);
            $tanggalKembali = !empty($validated['tanggal_kembali'])
                ? \Carbon\Carbon::parse($validated['tanggal_kembali'])
                : $transaction->tanggal_kembali;
            if ($tanggalKembali && $tanggalDikembalikan->gt($tanggalKembali)) {
                $hariTerlambat = (int) $tanggalDikembalikan->diffInDays($tanggalKembali);
                $denda = Transaction::hitungDenda($hariTerlambat);
            }
        }
        $validated['hari_terlambat'] = $hariTerlambat;
        $validated['denda'] = $denda;

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
