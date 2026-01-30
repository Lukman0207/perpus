@extends('layouts.admin')

@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Transaksi</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-600">Tanggal Transaksi</p>
                <p class="text-lg font-medium text-gray-800">{{ $transaction->created_at->format('d F Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tipe</p>
                <span class="px-2 py-1 text-xs rounded-full {{ $transaction->type === 'peminjaman' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-600">Status</p>
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ $transaction->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 
                        ($transaction->status === 'dikembalikan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tanggal Pinjam</p>
                <p class="text-lg font-medium text-gray-800">{{ $transaction->tanggal_pinjam->format('d F Y') }}</p>
            </div>
            @if($transaction->tanggal_kembali)
            <div>
                <p class="text-sm text-gray-600">Tanggal Kembali</p>
                <p class="text-lg font-medium text-gray-800">{{ $transaction->tanggal_kembali->format('d F Y') }}</p>
            </div>
            @endif
            @if($transaction->tanggal_dikembalikan)
            <div>
                <p class="text-sm text-gray-600">Tanggal Dikembalikan</p>
                <p class="text-lg font-medium text-gray-800">{{ $transaction->tanggal_dikembalikan->format('d F Y') }}</p>
            </div>
            @endif
            @if($transaction->keterangan)
            <div>
                <p class="text-sm text-gray-600">Keterangan</p>
                <p class="text-lg font-medium text-gray-800">{{ $transaction->keterangan }}</p>
            </div>
            @endif
        </div>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.transactions.edit', $transaction) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Edit
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Siswa</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">NIS</p>
                    <p class="font-medium text-gray-800">{{ $transaction->user->nis }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nama</p>
                    <p class="font-medium text-gray-800">{{ $transaction->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium text-gray-800">{{ $transaction->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kelas</p>
                    <p class="font-medium text-gray-800">{{ $transaction->user->kelas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Buku</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Judul</p>
                    <p class="font-medium text-gray-800">{{ $transaction->book->judul }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Penulis</p>
                    <p class="font-medium text-gray-800">{{ $transaction->book->penulis }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Penerbit</p>
                    <p class="font-medium text-gray-800">{{ $transaction->book->penerbit }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tahun</p>
                    <p class="font-medium text-gray-800">{{ $transaction->book->tahun }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Stok</p>
                    <p class="font-medium text-gray-800">{{ $transaction->book->stok }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection