<x-layouts.public title="Peta Desa">

    {{-- ================= PAGE HEADER ================= --}}
    <x-public-page-header title="Peta Desa"
        eyebrow="Lokasi & Wilayah"
        description="Lokasi dan wilayah {{ $profile->village_name }}"
        :crumbs="[['label' => 'Peta Desa']]" />

    {{-- ================= KONTEN UTAMA ================= --}}
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- BAGIAN KIRI: PETA --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2.5 mb-5">
                    <svg class="w-6 h-6 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-[#192E03]">Peta Wilayah Desa</h2>
                </div>

                @php
                    $mapUmkms = $umkms->filter(fn ($u) => $u->latitude && $u->longitude);
                    $mapFacilities = $facilities->filter(fn ($f) => $f->latitude && $f->longitude);
                @endphp

                @if ($mapUmkms->isNotEmpty() || $mapFacilities->isNotEmpty())
                    <x-interactive-map :umkms="$umkms" :facilities="$facilities" center-label="{{ $profile->village_name }}" height="h-96 lg:h-[500px]" />
                @else
                    <div class="rounded-2xl border border-slate-200 shadow-sm h-96 lg:h-[500px] bg-slate-50 flex flex-col items-center justify-center text-center px-6">
                        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <p class="text-lg font-bold text-slate-700">Peta belum tersedia</p>
                        <p class="text-sm text-slate-500 mt-1.5 max-w-md">
                            Admin dapat menambahkan titik UMKM dan fasilitas (beserta koordinat) melalui dashboard
                        </p>
                        @auth
                            <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                                <a href="{{ route('admin.umkm.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                    Tambah UMKM
                                </a>
                                <a href="{{ route('admin.fasilitas.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                    Tambah Fasilitas
                                </a>
                            </div>
                        @endauth
                    </div>
                @endif
            </div>

            {{-- BAGIAN KANAN: INFO DESA --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
                    <h3 class="text-base font-bold text-[#192E03]">Informasi Desa</h3>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400">Nama Desa</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $profile->village_name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400">Alamat</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">{{ $profile->address ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400">Luas Wilayah</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">
                                {{ $profile->area_size ? number_format($profile->area_size, 2, ',', '.') . ' km²' : '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-400">Jumlah Penduduk</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">
                                {{ $profile->population ? number_format($profile->population, 0, ',', '.') . ' jiwa' : '-' }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile-desa.show') }}"
                        class="block w-full py-3 bg-[#192E03] text-white text-sm font-medium rounded-xl text-center hover:bg-[#1F3B04] transition">
                        Lihat Profil Desa Lengkap
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layouts.public>
