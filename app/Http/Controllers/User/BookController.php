<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Satu kolom pencarian (judul, penulis, penerbit, ISBN, kategori)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Filter kategori (tombol cari sesuai kategori)
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $books = $query->latest()->paginate(12);

        // Kategori unik untuk dropdown
        $kategoris = Book::whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori')
            ->sort()
            ->values();

        // Add available stock
        foreach ($books as $book) {
            $borrowed = \App\Models\Transaction::where('book_id', $book->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->count();
            $book->available_stock = max(0, $book->stok - $borrowed);
        }

        return view('user.books.index', compact('books', 'kategoris'));
    }

    public function show(Book $book)
    {
        $borrowed = \App\Models\Transaction::where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();
        $book->available_stock = max(0, $book->stok - $borrowed);

        return view('user.books.show', compact('book'));
    }
}
