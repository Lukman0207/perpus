@extends('layouts.user')

@section('title', 'Dashboard Siswa')
@section('header', 'Dashboard Siswa')

@section('content')
{{-- Data Saya (profil singkat) --}}
<div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 mb-8 border border-slate-200 dark:border-slate-700">
    <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Data Saya</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
        <div>
            <p class="text-slate-600 dark:text-slate-400">Nama</p>
            <p class="font-medium text-slate-800 dark:text-white">{{ auth()->user()->name }}</p>
        </div>
        <div>
            <p class="text-slate-600 dark:text-slate-400">NIS</p>
            <p class="font-medium text-slate-800 dark:text-white">{{ auth()->user()->nis ?? '-' }}</p>
        </div>
        <div>
            <p class="text-slate-600 dark:text-slate-400">Kelas</p>
            <p class="font-medium text-slate-800 dark:text-white">{{ auth()->user()->kelas ?? '-' }}</p>
        </div>
        <div>
            <p class="text-slate-600 dark:text-slate-400">No. HP</p>
            <p class="font-medium text-slate-800 dark:text-white">{{ auth()->user()->no_hp ?? '-' }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-slate-600 dark:text-slate-400">Buku Dipinjam</p>
                <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $borrowedBooks->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 dark:bg-green-900/50 rounded-lg">
                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-slate-600 dark:text-slate-400">Buku Dikembalikan</p>
                <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $returnedBooks->count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 dark:bg-red-900/50 rounded-lg">
                <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-slate-600 dark:text-slate-400">Buku Terlambat</p>
                <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $overdueBooks->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-slate-800 rounded-xl shadow mb-6 border border-slate-200 dark:border-slate-700">
    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
        <h3 class="text-lg font-semibold text-slate-800 dark:text-white">Buku yang Sedang Dipinjam</h3>
    </div>
    <div class="p-6">
        @forelse($borrowedBooks as $transaction)
        <div class="border-b border-slate-200 dark:border-slate-700 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-semibold text-slate-800 dark:text-white">{{ $transaction->book->judul }}</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Penulis: {{ $transaction->book->penulis }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Pinjam: {{ $transaction->tanggal_pinjam->format('d/m/Y') }}</p>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Tanggal Kembali: {{ $transaction->tanggal_kembali ? $transaction->tanggal_kembali->format('d/m/Y') : '-' }}</p>
                </div>
                @php
                    $isOverdue = $transaction->status === 'terlambat' || ($transaction->tanggal_kembali && $transaction->tanggal_kembali->isPast());
                    $hariOverdue = $isOverdue && $transaction->tanggal_kembali ? (int) now()->diffInDays($transaction->tanggal_kembali) : 0;
                    $dendaOverdue = $hariOverdue > 0 ? \App\Models\Transaction::hitungDenda($hariOverdue) : 0;
                @endphp
                <form action="{{ route('user.transactions.return', $transaction) }}" method="POST" class="inline"
                    @if($isOverdue && $dendaOverdue > 0) data-confirm-denda data-hari-terlambat="{{ $hariOverdue }}" data-denda="{{ $dendaOverdue }}" @endif>
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">Kembalikan</button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-slate-500 dark:text-slate-400 text-center py-4">Tidak ada buku yang sedang dipinjam</p>
        @endforelse
    </div>
</div>

@if($overdueBooks->count() > 0)
<div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-6">
    <h3 class="text-lg font-semibold text-red-800 dark:text-red-300 mb-4">Peringatan: Buku Terlambat</h3>
    <ul class="space-y-2">
        @foreach($overdueBooks as $transaction)
        <li class="text-sm text-red-700 dark:text-red-400">{{ $transaction->book->judul }} - Jatuh tempo: {{ $transaction->tanggal_kembali->format('d/m/Y') }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Modal Info Denda (popup saat ada denda atau terlambat) --}}
@if($overdueBooks->count() > 0 || $totalDenda > 0)
<div id="modal-denda" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-denda-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-slate-900/70 dark:bg-slate-900/80 transition-opacity" aria-hidden="true" onclick="document.getElementById('modal-denda').classList.add('hidden')"></div>
        <div class="relative inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-slate-800 shadow-xl rounded-2xl border border-slate-200 dark:border-slate-700">
            <h3 id="modal-denda-title" class="text-lg font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                Informasi Denda & Keterlambatan
            </h3>
            <div class="space-y-4 text-sm">
                @if($overdueWithEstimate->count() > 0)
                <div>
                    <p class="font-semibold text-slate-700 dark:text-slate-300 mb-2">Buku yang terlambat (belum dikembalikan):</p>
                    <ul class="space-y-2">
                        @foreach($overdueWithEstimate as $item)
                        <li class="text-slate-600 dark:text-slate-400">
                            <span class="font-medium text-slate-800 dark:text-white">{{ $item->transaction->book->judul }}</span><br>
                            <span class="text-amber-600 dark:text-amber-400">Terlambat {{ $item->hari_terlambat }} hari</span> — Denda yang harus dibayar: <span class="font-semibold text-red-600 dark:text-red-400">Rp {{ number_format($item->denda_estimasi, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @php $totalEstimasi = $overdueWithEstimate->sum('denda_estimasi'); @endphp
                    <p class="mt-2 font-medium text-slate-800 dark:text-white">Total estimasi denda (jika dikembalikan hari ini): <span class="text-red-600 dark:text-red-400">Rp {{ number_format($totalEstimasi, 0, ',', '.') }}</span></p>
                </div>
                @endif
                @if($totalDenda > 0)
                <div>
                    <p class="font-semibold text-slate-700 dark:text-slate-300">Total denda dari pengembalian sebelumnya:</p>
                    <p class="text-lg font-bold text-red-600 dark:text-red-400">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
                </div>
                @endif
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" data-close-modal-denda onclick="document.getElementById('modal-denda').classList.add('hidden'); sessionStorage.setItem('modalDendaClosed', '1');" class="px-4 py-2 bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-800 dark:text-white rounded-lg font-medium">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@if($overdueBooks->count() > 0 || $totalDenda > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('modal-denda');
    if (modal && !sessionStorage.getItem('modalDendaClosed')) {
        modal.classList.remove('hidden');
    }
});
</script>
@endif
@endsection