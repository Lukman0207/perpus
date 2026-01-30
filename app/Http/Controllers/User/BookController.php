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

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->has('penulis')) {
            $query->where('penulis', 'like', "%{$request->penulis}%");
        }

        if ($request->has('penerbit')) {
            $query->where('penerbit', 'like', "%{$request->penerbit}%");
        }

        if ($request->has('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $books = $query->latest()->paginate(12);

        // Add available stock
        foreach ($books as $book) {
            $borrowed = \App\Models\Transaction::where('book_id', $book->id)
                ->where('type', 'peminjaman')
                ->where('status', 'dipinjam')
                ->count();
            $book->available_stock = max(0, $book->stok - $borrowed);
        }

        return view('user.books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $borrowed = \App\Models\Transaction::where('book_id', $book->id)
            ->where('type', 'peminjaman')
            ->where('status', 'dipinjam')
            ->count();
        $book->available_stock = max(0, $book->stok - $borrowed);

        return view('user.books.show', compact('book'));
    }
}
