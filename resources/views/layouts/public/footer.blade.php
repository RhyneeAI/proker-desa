<footer class="bg-[#192E03] text-slate-300">
    {{-- Kolom Utama --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Info Desa --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo/logo sugih mukti.png') }}"
                        alt="Logo desa"
                        class="w-12 h-12 object-contain">
                    <div>
                        <span class="text-white font-bold text-sm block">Desa Cibulakan</span>
                        <span class="text-[11px] uppercase tracking-widest text-[#3A5C0A] font-medium">Website Resmi Desa</span>
                    </div>
                </div>
                <p class="text-sm text-white/60 leading-relaxed max-w-md">
                    Media informasi resmi Pemerintah Desa Cibulakan. Menyajikan berita, pengumuman,
                    layanan publik, serta potensi desa untuk masyarakat.
                </p>
            </div>

            {{-- Navigasi --}}
            <div>
                <h4 class="text-white text-sm font-semibold mb-4 uppercase tracking-wider">Navigasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Beranda</a></li>
                    <li><a href="{{ route('profile-desa.show') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Profil Desa</a></li>
                    <li><a href="{{ route('peta-desa.show') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Peta Desa</a></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Berita</a></li>
                    <li><a href="{{ route('pengumuman.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Pengumuman</a></li>
                    <li><a href="{{ route('potensi.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Potensi Desa</a></li>
                </ul>
            </div>

            {{-- Layanan --}}
            <div>
                <h4 class="text-white text-sm font-semibold mb-4 uppercase tracking-wider">Layanan</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('aparatur.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Aparatur Desa</a></li>
                    <li><a href="{{ route('umkm.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>UMKM Desa</a></li>
                    <li><a href="{{ route('fasilitas.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Fasilitas Umum</a></li>
                    <li><a href="{{ route('galeri.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Galeri</a></li>
                    <li><a href="{{ route('kontak.show') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bar Bawah --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-white/50">
            <p>&copy; {{ date('Y') }} Pemerintah Desa Cibulakan. Seluruh hak cipta dilindungi.</p>
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 hover:text-[#3A5C0A] transition font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login Admin
            </a>
        </div>
    </div>
</footer>
