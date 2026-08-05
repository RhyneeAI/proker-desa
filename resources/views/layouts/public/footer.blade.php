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
                    Media informasi resmi Pemerintah Desa Cibulakan. Menyajikan berita, pengumuman, layanan publik, serta potensi desa untuk masyarakat.
                </p>
                <p class="text-xs text-white/40 mt-1">Dikembangkan oleh Luhung Lugina · M. Hasby Ashidiqqie · Vinna Laila Luqiana</p>

                @if ($contact?->facebook || $contact?->instagram || $contact?->youtube || $contact?->tiktok || $contact?->whatsapp)
                    <div class="flex items-center gap-3 mt-5">
                        <span class="text-xs font-semibold uppercase tracking-widest text-white/50">Ikuti Kami</span>
                        <div class="flex gap-2">
                            @if ($contact->facebook)
                                <a href="{{ $contact->facebook }}" target="_blank" rel="noopener"
                                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#3A5C0A] flex items-center justify-center text-white transition" aria-label="Facebook">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($contact->instagram)
                                <a href="{{ $contact->instagram }}" target="_blank" rel="noopener"
                                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#3A5C0A] flex items-center justify-center text-white transition" aria-label="Instagram">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm10 10a5 5 0 11-10 0 5 5 0 0110 0zm-9 0a4 4 0 108 0 4 4 0 00-8 0zm6.5-6.5a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($contact->youtube)
                                <a href="{{ $contact->youtube }}" target="_blank" rel="noopener"
                                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#3A5C0A] flex items-center justify-center text-white transition" aria-label="YouTube">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.5 6.19a3.02 3.02 0 00-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 00.5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 002.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 002.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($contact->tiktok)
                                <a href="{{ $contact->tiktok }}" target="_blank" rel="noopener"
                                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#3A5C0A] flex items-center justify-center text-white transition" aria-label="TikTok">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($contact->whatsapp)
                                <a href="https://wa.me/{{ \App\Support\PhoneNumber::waNumber($contact->whatsapp) }}" target="_blank" rel="noopener"
                                    class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#3A5C0A] flex items-center justify-center text-white transition" aria-label="WhatsApp">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.1-.198.05-.371-.025-.52-.074-.149-.668-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
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
                </ul>
            </div>

            {{-- Layanan --}}
            <div>
                <h4 class="text-white text-sm font-semibold mb-4 uppercase tracking-wider">Layanan</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('aparatur.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Aparatur Desa</a></li>
                    <li><a href="{{ route('umkm.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>UMKM Desa</a></li>
                    <li><a href="{{ route('fasilitas.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Fasilitas Umum</a></li>
                    <li><a href="{{ route('galeri.index') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Galeri Foto</a></li>
                    <li><a href="{{ route('kontak.show') }}" class="hover:text-[#3A5C0A] transition inline-flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-[#3A5C0A]"></span>Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bar Bawah --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-white/50">
            <p>&copy; {{ date('Y') }} Pemerintah Desa Cibulakan. Seluruh hak cipta dilindungi.</p>
            <span class="text-white/30 text-[11px] tracking-widest uppercase">KKN Desa Cibulakan</span>
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 hover:text-[#3A5C0A] transition font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Login Admin
            </a>
        </div>
    </div>
</footer>
