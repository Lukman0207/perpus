@extends('layouts.user')

@section('title', 'Pencarian Buku')
@section('header', 'Pencarian Buku')

@section('content')
<div class="mb-6 bg-white rounded-lg shadow p-6">
    <form method="GET" action="{{ route('user.books.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis, penerbit..." 
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        <input type="text" name="penulis" value="{{ request('penulis') }}" placeholder="Penulis" 
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        <input type="text" name="penerbit" value="{{ request('penerbit') }}" placeholder="Penerbit" 
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="Tahun" 
            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        <div class="md:col-span-4 flex gap-2">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">Cari</button>
            <a href="{{ route('user.books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">Reset</a>
        </div>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($books as $book)
    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $book->judul }}</h3>
            <p class="text-sm text-gray-600 mb-1"><span class="font-medium">Penulis:</span> {{ $book->penulis }}</p>
            <p class="text-sm text-gray-600 mb-1"><span class="font-medium">Penerbit:</span> {{ $book->penerbit }}</p>
            <p class="text-sm text-gray-600 mb-1"><span class="font-medium">Tahun:</span> {{ $book->tahun }}</p>
            <p class="text-sm text-gray-600 mb-4"><span class="font-medium">Stok Tersedia:</span> 
                <span class="{{ $book->available_stock > 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                    {{ $book->available_stock }} / {{ $book->stok }}
                </span>
            </p>
            @if($book->deskripsi)
            <p class="text-sm text-gray-700 mb-4 line-clamp-2">{{ Str::limit($book->deskripsi, 100) }}</p>
            @endif
            <div class="flex gap-2">
                <a href="{{ route('user.books.show', $book) }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg text-sm">
                    Detail
                </a>
                @if($book->available_stock > 0)
                <form action="{{ route('user.books.borrow', $book) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        Pinjam
                    </button>
                </form>
                @else
                <button disabled class="flex-1 bg-gray-300 text-gray-600 px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                    Habis
                </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12">
        <p class="text-gray-500 text-lg">Tidak ada buku yang ditemukan</p>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $books->links() }}
</div>
@endsection