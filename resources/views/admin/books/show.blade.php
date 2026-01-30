@extends('layouts.admin')

@section('title', 'Detail Buku')
@section('header', 'Detail Buku')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $book->judul }}</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Penulis</p>
                <p class="text-lg font-medium text-gray-800">{{ $book->penulis }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Penerbit</p>
                <p class="text-lg font-medium text-gray-800">{{ $book->penerbit }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tahun</p>
                <p class="text-lg font-medium text-gray-800">{{ $book->tahun }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Stok</p>
                <p class="text-lg font-medium text-gray-800">{{ $book->stok }}</p>
            </div>
            @if($book->isbn)
            <div>
                <p class="text-sm text-gray-600">ISBN</p>
                <p class="text-lg font-medium text-gray-800">{{ $book->isbn }}</p>
            </div>
            @endif
        </div>
        @if($book->deskripsi)
        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-2">Deskripsi</p>
            <p class="text-gray-800">{{ $book->deskripsi }}</p>
        </div>
        @endif
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.books.edit', $book) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
            Edit
        </a>
        <a href="{{ route('admin.books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
            Kembali
        </a>
    </div>
</div>
@endsection