<nav
    x-data="{
        isHome: {{ request()->routeIs('home') ? 'true' : 'false' }},
        scrolled: {{ request()->routeIs('home') ? 'false' : 'true' }},
        open: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = this.isHome ? window.scrollY > 50 : true
            })
        }
    }"
    :class="scrolled ? 'bg-[#192E03] shadow-lg' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center gap-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                <img src="{{ asset('images/logo/logo sugih mukti.png') }}"
                    alt="{{ $profile?->village_name ?? 'Logo desa' }}"
                    class="w-16 h-16 object-cover flex-shrink-0 mt-1">
                <div class="leading-tight">
                    <span class="block font-extrabold text-white text-base drop-shadow">
                        {{ $profile?->village_name ?? 'Desa Cibulakan' }}
                    </span>
                    <span class="block text-[11px] text-white/70 font-medium">
                        Kecamatan Cugenang, Kabupaten Cianjur
                    </span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-1 text-sm font-semibold">
                <a href="{{ route('home') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('home') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.home') }}
                </a>
                <a href="{{ route('profile-desa.show') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('profile-desa.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.profil') }}
                </a>
                <a href="{{ route('peta-desa.show') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('peta-desa.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.peta') }}
                </a>
                <a href="{{ route('berita.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('berita.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.berita') }}
                </a>
                <a href="{{ route('umkm.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('umkm.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.umkm') }}
                </a>
                <a href="{{ route('fasilitas.index') }}"
                    class="px-3 py-2 text-white transition {{ request()->routeIs('fasilitas.*') ? 'border-b-2 border-white' : 'opacity-80 hover:opacity-100' }}">
                    {{ __('nav.fasilitas') }}
                </a>
            </div>

            {{-- Aksi Kanan: Bahasa --}}
            <div class="flex items-center gap-3">
                @if (app()->getLocale() === 'id')
                    <a href="{{ route('locale.switch', 'en') }}"
                        class="px-2.5 py-1.5 rounded-full border border-white/30 text-white text-xs font-semibold hover:bg-white/10 transition"
                        aria-label="Switch to English">EN</a>
                @else
                    <a href="{{ route('locale.switch', 'id') }}"
                        class="px-2.5 py-1.5 rounded-full border border-white/30 text-white text-xs font-semibold hover:bg-white/10 transition"
                        aria-label="Ganti ke Bahasa Indonesia">ID</a>
                @endif
            </div>

            {{-- Hamburger Mobile --}}
            <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-white hover:bg-white/10 transition" aria-label="Menu">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak class="lg:hidden pb-4 pt-2 border-t border-white/10 space-y-1">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('home') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.home') }}
            </a>
            <a href="{{ route('profile-desa.show') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('profile-desa.*') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.profil') }}
            </a>
            <a href="{{ route('peta-desa.show') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('peta-desa.*') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.peta') }}
            </a>
            <a href="{{ route('berita.index') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('berita.*') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.berita') }}
            </a>
            <a href="{{ route('umkm.index') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('umkm.*') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.umkm') }}
            </a>
            <a href="{{ route('fasilitas.index') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium text-white transition hover:bg-white/10 {{ request()->routeIs('fasilitas.*') ? 'bg-white/10' : 'opacity-80' }}">
                {{ __('nav.fasilitas') }}
            </a>

            <div class="pt-3 mt-2 border-t border-white/10">
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center justify-center px-3 py-2 rounded-lg text-sm font-semibold text-[#192E03] bg-white hover:bg-white/90 transition">
                        {{ __('nav.dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center px-3 py-2 rounded-lg text-sm font-semibold text-[#192E03] bg-white hover:bg-white/90 transition">
                        {{ __('nav.login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
