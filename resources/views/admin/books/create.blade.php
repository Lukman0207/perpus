@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('header', 'Tambah Buku Baru')

@section('content')
<div class="max-w-2xl bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.books.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Buku *</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">Penulis *</label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="penerbit" class="block text-sm font-medium text-gray-700 mb-2">Penerbit *</label>
                <input type="text" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun *</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun') }}" required min="1000" max="{{ date('Y') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                <input type="number" id="stok" name="stok" value="{{ old('stok', 0) }}" required min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
            <a href="{{ route('admin.books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection