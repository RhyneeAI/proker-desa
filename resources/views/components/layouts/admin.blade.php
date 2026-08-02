<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} — Admin Desa Cibulakan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-700 antialiased" x-data="{ sidebarOpen: false }">

    {{-- Overlay mobile --}}
    <div x-show="sidebarOpen"
        x-cloak
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black/40 lg:hidden">
    </div>

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <x-admin-sidebar />

        {{-- Konten Utama --}}
        <div class="flex-1 flex flex-col lg:ml-64 min-w-0">

            {{-- Topbar --}}
            <header class="sticky top-0 z-20 bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 sm:px-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition" aria-label="Buka menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h1 class="text-base font-bold text-[#192E03] leading-tight">{{ $title ?? 'Dashboard' }}</h1>
                        <p class="text-xs text-slate-400 hidden sm:block">Panel Administrasi Website Desa</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-600 hidden sm:block">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-red-600 transition px-3 py-2 rounded-lg hover:bg-red-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="mx-4 sm:mx-6 mt-4 px-4 py-3 bg-[#192E03]/10 border border-[#192E03]/20 text-[#192E03] text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mx-4 sm:mx-6 mt-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Konten --}}
            <main class="flex-1 p-4 sm:p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
