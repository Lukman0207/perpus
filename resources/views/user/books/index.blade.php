@extends('layouts.user')

@section('title', 'Pencarian Buku')
@section('header', 'Pencarian Buku')

@section('content')
<div class="mb-8 rounded-2xl shadow-lg p-6 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
    <form method="GET" action="{{ route('user.books.index') }}" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari judul, penulis, penerbit, ISBN, atau kategori..." 
                class="flex-1 px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent placeholder-slate-500">
            <select name="kategori" class="px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent min-w-[140px]">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kat)
                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl flex items-center gap-2 transition shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Cari
            </button>
            <a href="{{ route('user.books.index') }}" class="px-6 py-3 bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-800 dark:text-white font-medium rounded-xl transition">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($books as $book)
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-200 dark:border-slate-700 group">
        <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
        <div class="p-6">
            @if($book->kategori)
            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 mb-3">
                {{ $book->kategori }}
            </span>
            @endif
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition line-clamp-2">{{ $book->judul }}</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1"><span class="font-medium">Penulis:</span> {{ $book->penulis }}</p>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-1"><span class="font-medium">Penerbit:</span> {{ $book->penerbit }}</p>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4"><span class="font-medium">Tahun:</span> {{ $book->tahun }}</p>
            <p class="text-sm mb-4">
                <span class="font-medium text-slate-600 dark:text-slate-400">Stok Tersedia: </span>
                <span class="{{ $book->available_stock > 0 ? 'text-emerald-600 dark:text-emerald-400 font-bold' : 'text-red-600 dark:text-red-400 font-bold' }}">
                    {{ $book->available_stock }} / {{ $book->stok }}
                </span>
            </p>
            @if($book->deskripsi)
            <p class="text-sm text-slate-700 dark:text-slate-300 mb-4 line-clamp-2">{{ Str::limit($book->deskripsi, 80) }}</p>
            @endif
            <div class="flex gap-2">
                <a href="{{ route('user.books.show', $book) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2.5 rounded-xl text-sm font-medium transition">
                    Detail
                </a>
                @if($book->available_stock > 0)
                <form action="{{ route('user.books.borrow', $book) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">
                        Pinjam
                    </button>
                </form>
                @else
                <button disabled class="flex-1 bg-slate-300 dark:bg-slate-600 text-slate-500 dark:text-slate-400 px-4 py-2.5 rounded-xl text-sm cursor-not-allowed">
                    Habis
                </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16">
        <svg class="w-24 h-24 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
        <p class="text-slate-500 dark:text-slate-400 text-lg">Tidak ada buku yang ditemukan</p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $books->links() }}
</div>
@endsection