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
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.profil-desa.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.profil-desa.edit') }}">
                        <span class="nav-link-icon"><i class="ti ti-building"></i></span>
                        <span class="nav-link-title">Profil Desa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.potensi-desa.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.potensi-desa.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-mountain"></i></span>
                        <span class="nav-link-title">Potensi Desa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.aparatur.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.aparatur.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-users-group"></i></span>
                        <span class="nav-link-title">Aparatur Desa</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.berita.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-news"></i></span>
                        <span class="nav-link-title">Berita</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.pengumuman.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-megaphone"></i></span>
                        <span class="nav-link-title">Pengumuman</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.umkm.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-shopping-bag"></i></span>
                        <span class="nav-link-title">UMKM</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.fasilitas.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-map-pin"></i></span>
                        <span class="nav-link-title">Fasilitas Umum</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.titik-air.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.titik-air.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-droplet"></i></span>
                        <span class="nav-link-title">Titik Air</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.wisata.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.wisata.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-map-pin-cog"></i></span>
                        <span class="nav-link-title">Wisata</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.potensi.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.potensi.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-tools-kitchen-2"></i></span>
                        <span class="nav-link-title">Potensi & Produk</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.galeri.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-photo"></i></span>
                        <span class="nav-link-title">Galeri</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.kontak.edit') }}">
                        <span class="nav-link-icon"><i class="ti ti-phone"></i></span>
                        <span class="nav-link-title">Kontak</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.pengguna.index') }}">
                        <span class="nav-link-icon"><i class="ti ti-users"></i></span>
                        <span class="nav-link-title">Pengguna</span>
                    </a>
                </li>
            </ul>

            <div class="mt-auto py-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-100 text-start">
                        <span class="nav-link-icon"><i class="ti ti-logout"></i></span>
                        <span class="nav-link-title">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
