@extends('layouts.admin')

@section('title', 'Edit Anggota')
@section('header', 'Edit Data Anggota')

@section('content')
<div class="max-w-2xl bg-white dark:bg-slate-800 rounded-xl shadow p-6 border border-slate-200 dark:border-slate-700">
    <form method="POST" action="{{ route('admin.members.update', $member) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required autofocus
                class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" required
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="nis" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">NIS *</label>
                <input type="text" id="nis" name="nis" value="{{ old('nis', $member->nis) }}" required
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="kelas" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kelas *</label>
                <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $member->kelas) }}" required placeholder="Contoh: XII IPA 1"
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="no_hp" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}" placeholder="081234567890"
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alamat *</label>
            <textarea id="alamat" name="alamat" required rows="3"
                class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('alamat', $member->alamat) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Update</button>
            <a href="{{ route('admin.members.index') }}" class="bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-800 dark:text-white px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>
@endsection