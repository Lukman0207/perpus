@extends('layouts.admin')

@section('title', 'Detail Anggota')
@section('header', 'Detail Anggota')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Anggota</h3>
        <div class="space-y-4">
            <div>
                <p class="text-sm text-gray-600">NIS</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->nis }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Nama Lengkap</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Email</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Kelas</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->kelas }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Alamat</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->alamat }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Terdaftar Sejak</p>
                <p class="text-lg font-medium text-gray-800">{{ $member->created_at->format('d F Y') }}</p>
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.members.edit', $member) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Edit
            </a>
            <a href="{{ route('admin.members.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Riwayat Transaksi</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($transactions as $transaction)
            <div class="border-b pb-4 last:border-b-0">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $transaction->book->judul }}</h4>
                        <p class="text-sm text-gray-600">{{ $transaction->book->penulis }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs rounded-full 
                        {{ $transaction->status === 'dipinjam' ? 'bg-yellow-100 text-yellow-800' : 
                            ($transaction->status === 'dikembalikan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 space-y-1">
                    <p>Pinjam: {{ $transaction->tanggal_pinjam->format('d/m/Y') }}</p>
                    <p>Kembali: {{ $transaction->tanggal_kembali ? $transaction->tanggal_kembali->format('d/m/Y') : '-' }}</p>
                    @if($transaction->tanggal_dikembalikan)
                    <p>Dikembalikan: {{ $transaction->tanggal_dikembalikan->format('d/m/Y') }}</p>
                    @endif
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Belum ada transaksi</p>
            @endforelse
        </div>
        @if($transactions->hasPages())
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection