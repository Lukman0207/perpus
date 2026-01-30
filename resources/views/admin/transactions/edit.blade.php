@extends('layouts.admin')

@section('title', 'Edit Transaksi')
@section('header', 'Edit Transaksi')

@section('content')
<div class="max-w-2xl bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Siswa *</label>
            <select id="user_id" name="user_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Pilih Siswa</option>
                @foreach($members as $member)
                <option value="{{ $member->id }}" {{ old('user_id', $transaction->user_id) == $member->id ? 'selected' : '' }}>
                    {{ $member->nis }} - {{ $member->name }} ({{ $member->kelas }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="book_id" class="block text-sm font-medium text-gray-700 mb-2">Buku *</label>
            <select id="book_id" name="book_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Pilih Buku</option>
                @foreach($books as $book)
                <option value="{{ $book->id }}" {{ old('book_id', $transaction->book_id) == $book->id ? 'selected' : '' }}>
                    {{ $book->judul }} - {{ $book->penulis }} (Stok: {{ $book->stok }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pinjam *</label>
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $transaction->tanggal_pinjam->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali', $transaction->tanggal_kembali ? $transaction->tanggal_kembali->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                <select id="status" name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="dipinjam" {{ old('status', $transaction->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ old('status', $transaction->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="terlambat" {{ old('status', $transaction->status) == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>

            <div>
                <label for="tanggal_dikembalikan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dikembalikan</label>
                <input type="date" id="tanggal_dikembalikan" name="tanggal_dikembalikan" value="{{ old('tanggal_dikembalikan', $transaction->tanggal_dikembalikan ? $transaction->tanggal_dikembalikan->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-6">
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('keterangan', $transaction->keterangan) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Update Transaksi
            </button>
            <a href="{{ route('admin.transactions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection