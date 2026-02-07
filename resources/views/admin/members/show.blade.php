@extends('layouts.admin')

@section('title', 'Detail Anggota')
@section('header', 'Detail Anggota')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6">Informasi Anggota</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">NIS</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->nis }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Nama Lengkap</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->name }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Email</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->email }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Nomor HP</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->no_hp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Kelas</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->kelas }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Alamat</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->alamat }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-600 dark:text-slate-400">Terdaftar Sejak</p>
                <p class="text-lg font-medium text-slate-800 dark:text-white">{{ $member->created_at->format('d F Y') }}</p>
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.members.edit', $member) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Edit</a>
            <a href="{{ route('admin.members.index') }}" class="bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-800 dark:text-white px-6 py-2 rounded-lg">Kembali</a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6">Riwayat Transaksi</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($transactions as $transaction)
            <div class="border-b border-slate-200 dark:border-slate-700 pb-4 last:border-b-0">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h4 class="font-semibold text-slate-800 dark:text-white">{{ $transaction->book->judul }}</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $transaction->book->penulis }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full {{ $transaction->status === 'dipinjam' ? 'bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300' : ($transaction->status === 'dikembalikan' ? 'bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300' : 'bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300') }}">{{ ucfirst($transaction->status) }}</span>
                </div>
                <div class="text-xs text-slate-500 dark:text-slate-400 space-y-1">
                    <p>Pinjam: {{ $transaction->tanggal_pinjam->format('d/m/Y') }}</p>
                    <p>Kembali: {{ $transaction->tanggal_kembali ? $transaction->tanggal_kembali->format('d/m/Y') : '-' }}</p>
                    @if($transaction->tanggal_dikembalikan)
                    <p>Dikembalikan: {{ $transaction->tanggal_dikembalikan->format('d/m/Y') }}</p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-slate-500 dark:text-slate-400 text-center py-4">Belum ada transaksi</p>
            @endforelse
        </div>
        @if($transactions->hasPages())
        <div class="mt-4">{{ $transactions->links() }}</div>
        @endif
    </div>
</div>
@endsection