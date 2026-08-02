<aside class="navbar navbar-expand-lg navbar-vertical navbar-dark flex-shrink-0" data-bs-theme="dark">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand me-0" href="{{ route('admin.dashboard') }}">
            <span class="navbar-brand-image">
                <img src="{{ asset('images/logo/logo sugih mukti.png') }}"
                    alt="Logo Desa Cibulakan"
                    class="rounded" style="height:2.5rem;width:auto;object-fit:contain">
            </span>
            <span class="navbar-brand-title">Desa Cibulakan</span>
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
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Kelompok: Konten --}}
                <li class="nav-item" x-data="{ open: {{ $activeGroup === 'konten' ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open" class="nav-link w-100 text-start" aria-expanded="false">
                        <span class="nav-link-icon"><i class="ti ti-file-text"></i></span>
                        <span>Konten</span>
                        <span class="nav-link-toggle"></span>
                    </button>
                    <div x-show="open" x-cloak class="nav-submenu">
                        <a href="{{ route('admin.berita.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.berita.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-news" style="width:1.25rem"></i> Berita</a>
                        <a href="{{ route('admin.pengumuman.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.pengumuman.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-speakerphone" style="width:1.25rem"></i> Pengumuman</a>
                        <a href="{{ route('admin.galeri.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.galeri.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-photo" style="width:1.25rem"></i> Galeri</a>
                    </div>
                </li>

                {{-- Kelompok: Ekonomi & Wisata --}}
                <li class="nav-item" x-data="{ open: {{ $activeGroup === 'ekonomi' ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open" class="nav-link w-100 text-start" aria-expanded="false">
                        <span class="nav-link-icon"><i class="ti ti-shopping-bag"></i></span>
                        <span>Ekonomi & Wisata</span>
                        <span class="nav-link-toggle"></span>
                    </button>
                    <div x-show="open" x-cloak class="nav-submenu">
                        <a href="{{ route('admin.umkm.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.umkm.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-shopping-bag" style="width:1.25rem"></i> UMKM</a>
                        <a href="{{ route('admin.wisata.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.wisata.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-map-pin-cog" style="width:1.25rem"></i> Wisata</a>
                        <a href="{{ route('admin.potensi.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.potensi.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-tools-kitchen-2" style="width:1.25rem"></i> Potensi & Produk</a>
                    </div>
                </li>

                {{-- Kelompok: Wilayah & Infrastruktur --}}
                <li class="nav-item" x-data="{ open: {{ $activeGroup === 'wilayah' ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open" class="nav-link w-100 text-start" aria-expanded="false">
                        <span class="nav-link-icon"><i class="ti ti-map-pin"></i></span>
                        <span>Wilayah & Infrastruktur</span>
                        <span class="nav-link-toggle"></span>
                    </button>
                    <div x-show="open" x-cloak class="nav-submenu">
                        <a href="{{ route('admin.fasilitas.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.fasilitas.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-building-community" style="width:1.25rem"></i> Fasilitas Umum</a>
                        <a href="{{ route('admin.titik-air.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.titik-air.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-droplet" style="width:1.25rem"></i> Titik Air</a>
                        <a href="{{ route('admin.potensi-desa.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.potensi-desa.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-mountain" style="width:1.25rem"></i> Potensi Desa</a>
                    </div>
                </li>

                {{-- Kelompok: Pengaturan --}}
                <li class="nav-item" x-data="{ open: {{ $activeGroup === 'pengaturan' ? 'true' : 'false' }} }">
                    <button type="button" @click="open = !open" class="nav-link w-100 text-start" aria-expanded="false">
                        <span class="nav-link-icon"><i class="ti ti-settings"></i></span>
                        <span>Pengaturan</span>
                        <span class="nav-link-toggle"></span>
                    </button>
                    <div x-show="open" x-cloak class="nav-submenu">
                        <a href="{{ route('admin.profil-desa.edit') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.profil-desa.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-building" style="width:1.25rem"></i> Profil Desa</a>
                        <a href="{{ route('admin.kontak.edit') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.kontak.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-phone" style="width:1.25rem"></i> Kontak</a>
                        <a href="{{ route('admin.pengguna.index') }}" class="d-flex align-items-center gap-2 py-2 ps-5 pe-3 small rounded {{ request()->routeIs('admin.pengguna.*') ? 'text-white bg-white bg-opacity-10' : 'text-secondary' }}"><i class="ti ti-users" style="width:1.25rem"></i> Pengguna</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
