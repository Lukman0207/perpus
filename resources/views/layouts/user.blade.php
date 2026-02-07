<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Siswa') - Perpustakaan Sekolah Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 dark:bg-slate-900 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-emerald-800 to-teal-900 dark:from-slate-900 dark:to-slate-800 text-white flex flex-col shadow-xl">
            <div class="p-6 border-b border-emerald-700 dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Perpustakaan</h1>
                        <p class="text-emerald-200 text-xs">Sekolah Digital</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition {{ request()->routeIs('user.dashboard') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('user.books.index') }}" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition {{ request()->routeIs('user.books.*') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Pencarian Buku
                </a>
                <a href="{{ route('user.transactions.index') }}" class="flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition {{ request()->routeIs('user.transactions.*') ? 'bg-white/20' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Riwayat Transaksi
                </a>
            </nav>
            <div class="p-4 border-t border-emerald-700 dark:border-slate-700">
                <div class="mb-4">
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-emerald-200">{{ Auth::user()->nis }} - {{ Auth::user()->kelas }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl transition font-medium flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white dark:bg-slate-800 shadow-sm border-b border-slate-200 dark:border-slate-700 px-6 py-4 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-white">@yield('header')</h2>
                <button id="theme-toggle" type="button" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 transition" title="Ubah tema">
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
            </header>
            <main class="flex-1 overflow-y-auto p-6 bg-slate-100 dark:bg-slate-900 relative bg-animate-perpus">
                <div class="float-shape float-shape-1" aria-hidden="true"></div>
                <div class="float-shape float-shape-2" aria-hidden="true"></div>
                <div class="float-shape float-shape-3" aria-hidden="true"></div>
                <div class="relative z-10">
                @if(session('success'))
                    <div class="mb-4 bg-emerald-100 dark:bg-emerald-900/50 border border-emerald-400 text-emerald-800 dark:text-emerald-200 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 bg-red-100 dark:bg-red-900/50 border border-red-400 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl">
                        {{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 bg-red-100 dark:bg-red-900/50 border border-red-400 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
                </div>
            </main>
        </div>
    </div>
    {{-- Konfirmasi denda saat klik Kembalikan (buku terlambat) --}}
    <script>
    document.querySelectorAll('form[data-confirm-denda]').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            var hari = parseInt(form.getAttribute('data-hari-terlambat') || '0', 10);
            var denda = form.getAttribute('data-denda') || '0';
            if (hari > 0 && denda !== '0') {
                var dendaNum = parseInt(denda, 10);
                var msg = 'Anda mengembalikan buku terlambat.\n\nTerlambat: ' + hari + ' hari\nDenda yang harus dibayar: Rp ' + dendaNum.toLocaleString('id-ID') + '\n\nLanjutkan?';
                if (!confirm(msg)) {
                    e.preventDefault();
                }
            }
        });
    });
    </script>
</body>
</html>