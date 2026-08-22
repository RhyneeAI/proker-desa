<nav
    x-data="{
        isHome: {{ request()->routeIs('home') ? 'true' : 'false' }},
        scrolled: {{ request()->routeIs('home') ? 'false' : 'true' }},
        open: false,
        themeDark: document.documentElement.getAttribute('data-theme') === 'dark',
        toggleTheme() {
            this.themeDark = !this.themeDark
            document.documentElement.setAttribute('data-theme', this.themeDark ? 'dark' : '')
            localStorage.setItem('theme', this.themeDark ? 'dark' : 'light')
        },
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = this.isHome ? window.scrollY > 50 : true
            }, { passive: true })
        }
    }"
    :class="(scrolled || open) ? 'bg-[#192E03] shadow-lg' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 pt-[env(safe-area-inset-top)]"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 sm:h-20 items-center gap-3">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1 lg:flex-none">
                <img src="{{ asset('images/logo/logo sugih mukti.png') }}"
                    alt="{{ $profile?->village_name ?? 'Logo desa' }}"
                    class="w-10 h-10 sm:w-14 sm:h-14 lg:w-16 lg:h-16 object-cover flex-shrink-0">
                <div class="leading-tight min-w-0">
                    <span class="block font-extrabold text-white text-sm sm:text-base drop-shadow truncate">
                        {{ $profile?->village_name ?? 'Desa Cibulakan' }}
                    </span>
                    <span class="hidden sm:block text-[11px] text-white/70 font-medium truncate">
                        Kecamatan Cugenang, Kabupaten Cianjur
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1 text-sm font-semibold">
                <a href="{{ route('home') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('home') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    Beranda
                </a>
                <a href="{{ route('profile-desa.show') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('profile-desa.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    Profil Desa
                </a>
                <a href="{{ route('peta-desa.show') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('peta-desa.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    Peta Desa
                </a>
                <a href="{{ route('berita.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('berita.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    Berita
                </a>
                <a href="{{ route('umkm.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('umkm.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    UMKM
                </a>
                <a href="{{ route('fasilitas.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('fasilitas.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    Fasilitas
                </a>
            </div>

            {{-- Aksi kanan: tema + hamburger --}}
            <div class="flex items-center gap-1 flex-shrink-0">
                <button @click="toggleTheme()"
                    class="w-11 h-11 rounded-full border border-white/30 text-white flex items-center justify-center hover:bg-white/10 transition"
                    :aria-label="themeDark ? 'Mode terang' : 'Mode gelap'">
                    <svg x-show="themeDark" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg x-show="!themeDark" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <button @click="open = !open" class="lg:hidden w-11 h-11 flex items-center justify-center rounded-lg text-white hover:bg-white/10 transition" aria-label="Menu" :aria-expanded="open">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak x-transition
            class="lg:hidden pb-4 pt-2 border-t border-white/10 grid grid-cols-2 gap-1">
            @foreach ([
                ['home', 'Beranda', 'home'],
                ['profile-desa.show', 'Profil Desa', 'profile-desa.*'],
                ['peta-desa.show', 'Peta Desa', 'peta-desa.*'],
                ['berita.index', 'Berita', 'berita.*'],
                ['pengumuman.index', 'Pengumuman', 'pengumuman.*'],
                ['aparatur.index', 'Aparatur', 'aparatur.*'],
                ['umkm.index', 'UMKM', 'umkm.*'],
                ['wisata.index', 'Wisata', 'wisata.*'],
                ['fasilitas.index', 'Fasilitas', 'fasilitas.*'],
                ['potensi.index', 'Potensi Desa', 'potensi.*'],
                ['galeri.index', 'Galeri', 'galeri.*'],
                ['kontak.show', 'Kontak', 'kontak.*'],
            ] as $item)
                <a href="{{ route($item[0]) }}"
                    class="flex items-center min-h-11 px-3 py-2.5 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs($item[2]) ? 'bg-white/10' : 'opacity-90' }}">
                    {{ $item[1] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
