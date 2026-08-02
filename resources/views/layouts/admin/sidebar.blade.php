<aside class="navbar navbar-expand-lg navbar-vertical navbar-dark flex-shrink-0" data-bs-theme="dark">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand me-0" href="{{ route('admin.dashboard') }}">
            <span class="navbar-brand-image">
                <span class="avatar avatar-sm bg-white text-[#192E03] fw-bold rounded">DS</span>
            </span>
            <span class="navbar-brand-title">Admin Desa</span>
        </a>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            @php
                $activeGroup = null;
                if (request()->routeIs('admin.berita.*') || request()->routeIs('admin.pengumuman.*') || request()->routeIs('admin.galeri.*')) $activeGroup = 'konten';
                if (request()->routeIs('admin.umkm.*') || request()->routeIs('admin.wisata.*') || request()->routeIs('admin.potensi.*')) $activeGroup = 'ekonomi';
                if (request()->routeIs('admin.fasilitas.*') || request()->routeIs('admin.titik-air.*') || request()->routeIs('admin.potensi-desa.*')) $activeGroup = 'wilayah';
                if (request()->routeIs('admin.profil-desa.*') || request()->routeIs('admin.kontak.*') || request()->routeIs('admin.pengguna.*')) $activeGroup = 'pengaturan';
            @endphp

            <ul class="navbar-nav pt-lg-3">

                {{-- Dashboard --}}
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>

                {{-- Kelompok: Konten --}}
                <li x-data="{ open: {{ $activeGroup === 'konten' ? 'true' : 'false' }} }" class="nav-item">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <span class="nav-link-icon"><i class="ti ti-file-text"></i></span>
                        <span class="nav-link-title flex-1 text-left">Konten</span>
                        <i class="ti ti-chevron-down text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="mt-1 space-y-0.5">
                        <a href="{{ route('admin.berita.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.berita.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Berita</a>
                        <a href="{{ route('admin.pengumuman.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.pengumuman.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Pengumuman</a>
                        <a href="{{ route('admin.galeri.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.galeri.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Galeri</a>
                    </div>
                </li>

                {{-- Kelompok: Ekonomi & Pariwisata --}}
                <li x-data="{ open: {{ $activeGroup === 'ekonomi' ? 'true' : 'false' }} }" class="nav-item">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <span class="nav-link-icon"><i class="ti ti-shopping-bag"></i></span>
                        <span class="nav-link-title flex-1 text-left">Ekonomi & Wisata</span>
                        <i class="ti ti-chevron-down text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="mt-1 space-y-0.5">
                        <a href="{{ route('admin.umkm.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.umkm.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">UMKM</a>
                        <a href="{{ route('admin.wisata.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.wisata.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Wisata</a>
                        <a href="{{ route('admin.potensi.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.potensi.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Potensi & Produk</a>
                    </div>
                </li>

                {{-- Kelompok: Wilayah & Infrastruktur --}}
                <li x-data="{ open: {{ $activeGroup === 'wilayah' ? 'true' : 'false' }} }" class="nav-item">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <span class="nav-link-icon"><i class="ti ti-map-pin"></i></span>
                        <span class="nav-link-title flex-1 text-left">Wilayah & Infrastruktur</span>
                        <i class="ti ti-chevron-down text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="mt-1 space-y-0.5">
                        <a href="{{ route('admin.fasilitas.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.fasilitas.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Fasilitas Umum</a>
                        <a href="{{ route('admin.titik-air.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.titik-air.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Titik Air</a>
                        <a href="{{ route('admin.potensi-desa.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.potensi-desa.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Potensi Desa</a>
                    </div>
                </li>

                {{-- Kelompok: Pengaturan --}}
                <li x-data="{ open: {{ $activeGroup === 'pengaturan' ? 'true' : 'false' }} }" class="nav-item">
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition">
                        <span class="nav-link-icon"><i class="ti ti-settings"></i></span>
                        <span class="nav-link-title flex-1 text-left">Pengaturan</span>
                        <i class="ti ti-chevron-down text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="mt-1 space-y-0.5">
                        <a href="{{ route('admin.profil-desa.edit') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.profil-desa.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Profil Desa</a>
                        <a href="{{ route('admin.kontak.edit') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.kontak.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Kontak</a>
                        <a href="{{ route('admin.pengguna.index') }}"
                            class="flex items-center gap-2 pl-11 pr-3 py-2 text-[13px] font-medium rounded-lg transition {{ request()->routeIs('admin.pengguna.*') ? 'text-white bg-white/10' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">Pengguna</a>
                    </div>
                </li>
            </ul>

            {{-- Keluar --}}
            <div class="mt-auto px-3 py-3 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-300 hover:bg-red-500/10 hover:text-red-400 transition">
                        <i class="ti ti-logout text-lg"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
