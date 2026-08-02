<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-slate-300 transform transition-transform duration-200 ease-in-out flex flex-col"
    x-cloak>

    {{-- Logo --}}
    <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#192E03]/50 to-[#2D4D08] flex items-center justify-center">
                <span class="text-white text-xs font-extrabold">DS</span>
            </div>
            <div>
                <span class="text-white text-sm font-bold block leading-tight">Admin Desa</span>
                <span class="text-[10px] text-[#3A5C0A] uppercase tracking-widest">Panel Kelola</span>
            </div>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded text-slate-400 hover:text-white" aria-label="Tutup menu">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">

        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-600">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.dashboard') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 13h6V3H4v10zm10 8h6v-6h-6v6zM4 21h6v-4H4v4zm10-12h6V3h-6v6z"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.profil-desa.edit') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.profil-desa.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
            </svg>
            Profil Desa
        </a>

        <a href="{{ route('admin.potensi-desa.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.potensi-desa.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
            </svg>
            Potensi Desa
        </a>

        <a href="{{ route('admin.aparatur.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.aparatur.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
            </svg>
            Aparatur Desa
        </a>

        <a href="{{ route('admin.berita.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.berita.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
            </svg>
            Berita
        </a>

        <a href="{{ route('admin.pengumuman.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.pengumuman.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5"/>
            </svg>
            Pengumuman
        </a>

        <a href="{{ route('admin.umkm.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.umkm.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            UMKM
        </a>

        <a href="{{ route('admin.fasilitas.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.fasilitas.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            </svg>
            Fasilitas Umum
        </a>

        <a href="{{ route('admin.potensi.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.potensi.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            Potensi Desa
        </a>

        <a href="{{ route('admin.galeri.index') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.galeri.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Galeri
        </a>

        <a href="{{ route('admin.kontak.edit') }}"
            class="relative flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('admin.kontak.*') ? 'bg-[#192E03] text-white shadow-sm' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
            </svg>
            Kontak
        </a>
    </nav>

    {{-- Footer Sidebar --}}
    <div class="px-4 py-4 border-t border-slate-800 flex-shrink-0">
        <p class="text-xs text-slate-600 text-center">Pemerintah Desa Cibulakan<br>&copy; {{ date('Y') }}</p>
    </div>
</aside>
