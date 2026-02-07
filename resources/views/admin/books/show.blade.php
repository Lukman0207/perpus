@extends('layouts.admin')

@section('title', 'Detail Buku')
@section('header', 'Detail Buku')

@section('content')
<div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 max-w-3xl border border-slate-200 dark:border-slate-700">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-4">{{ $book->judul }}</h3>
        <div class="grid grid-cols-2 gap-4">
            <div><p class="text-sm text-slate-600 dark:text-slate-400">Penulis</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->penulis }}</p></div>
            <div><p class="text-sm text-slate-600 dark:text-slate-400">Penerbit</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->penerbit }}</p></div>
            <div><p class="text-sm text-slate-600 dark:text-slate-400">Tahun</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->tahun }}</p></div>
            <div><p class="text-sm text-slate-600 dark:text-slate-400">Stok</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->stok }}</p></div>
            @if($book->kategori)<div><p class="text-sm text-slate-600 dark:text-slate-400">Kategori</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->kategori }}</p></div>@endif
            @if($book->isbn)<div><p class="text-sm text-slate-600 dark:text-slate-400">ISBN</p><p class="text-lg font-medium text-slate-800 dark:text-white">{{ $book->isbn }}</p></div>@endif
        </div>
        @if($book->deskripsi)
        <div class="mt-4"><p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Deskripsi</p><p class="text-slate-800 dark:text-white">{{ $book->deskripsi }}</p></div>
        @endif
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.books.edit', $book) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Edit</a>
        <a href="{{ route('admin.books.index') }}" class="bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-800 dark:text-white px-6 py-2 rounded-lg">Kembali</a>
    </div>
</div>
@endsection