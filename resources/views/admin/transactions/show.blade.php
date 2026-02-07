@extends('layouts.admin')

@section('title', 'Detail Transaksi')
@section('header', 'Detail Transaksi')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6">Informasi Transaksi</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Transaksi</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $transaction->created_at->format('d F Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tipe</p>
                <span class="px-2 py-1 text-xs rounded-full {{ $transaction->type === 'peminjaman' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300' : 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Status</p>
                <span class="px-2 py-1 text-xs rounded-full 
                    {{ $transaction->status === 'dipinjam' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' : 
                        ($transaction->status === 'dikembalikan' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Pinjam</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $transaction->tanggal_pinjam->format('d F Y') }}</p>
            </div>
            @if($transaction->tanggal_kembali)
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Kembali</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $transaction->tanggal_kembali->format('d F Y') }}</p>
            </div>
            @endif
            @if($transaction->tanggal_dikembalikan)
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Dikembalikan</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $transaction->tanggal_dikembalikan->format('d F Y') }}</p>
            </div>
            @endif
            @if($transaction->hari_terlambat > 0)
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Terlambat</p>
                <p class="text-lg font-medium text-red-600 dark:text-red-400">{{ $transaction->hari_terlambat }} hari - Denda: Rp {{ number_format($transaction->denda, 0, ',', '.') }}</p>
            </div>
            @endif
            @if($transaction->keterangan)
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Keterangan</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $transaction->keterangan }}</p>
            </div>
            @endif
        </div>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.transactions.edit', $transaction) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Edit
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="bg-slate-300 dark:bg-slate-600 hover:bg-slate-400 dark:hover:bg-slate-500 text-slate-800 dark:text-white px-6 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4">Informasi Siswa</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">NIS</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->user->nis }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Nama</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Email</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">No. HP</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->user->no_hp ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Kelas</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->user->kelas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-4">Informasi Buku</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Judul</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->book->judul }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Penulis</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->book->penulis }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Penerbit</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->book->penerbit }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Tahun</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->book->tahun }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Stok</p>
                    <p class="font-medium text-slate-800 dark:text-white">{{ $transaction->book->stok }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection