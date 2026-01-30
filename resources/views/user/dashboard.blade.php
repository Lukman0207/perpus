@extends('layouts.user')

@section('title', 'Dashboard Siswa')
@section('header', 'Dashboard Siswa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Buku Dipinjam</p>
                <p class="text-2xl font-bold text-gray-800">{{ $borrowedBooks->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Buku Dikembalikan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $returnedBooks->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-lg">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Buku Terlambat</p>
                <p class="text-2xl font-bold text-gray-800">{{ $overdueBooks->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6 border-b">
        <h3 class="text-lg font-semibold text-gray-800">Buku yang Sedang Dipinjam</h3>
    </div>
    <div class="p-6">
        @forelse($borrowedBooks as $transaction)
        <div class="border-b pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-semibold text-gray-800">{{ $transaction->book->judul }}</h4>
                    <p class="text-sm text-gray-600">Penulis: {{ $transaction->book->penulis }}</p>
                    <p class="text-sm text-gray-600">Tanggal Pinjam: {{ $transaction->tanggal_pinjam->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-600">Tanggal Kembali: {{ $transaction->tanggal_kembali->format('d/m/Y') }}</p>
                </div>
                <form action="{{ route('user.transactions.return', $transaction) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        Kembalikan
                    </button>
                </form>
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-center py-4">Tidak ada buku yang sedang dipinjam</p>
        @endforelse
    </div>
</div>

@if($overdueBooks->count() > 0)
<div class="bg-red-50 border border-red-200 rounded-lg p-6">
    <h3 class="text-lg font-semibold text-red-800 mb-4">Peringatan: Buku Terlambat</h3>
    <ul class="space-y-2">
        @foreach($overdueBooks as $transaction)
        <li class="text-sm text-red-700">{{ $transaction->book->judul }} - Jatuh tempo: {{ $transaction->tanggal_kembali->format('d/m/Y') }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection