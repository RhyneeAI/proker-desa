<x-layouts.public title="Profil Desa">

    {{-- ================= PAGE HEADER ================= --}}
    <x-public-page-header title="Profil Desa"
        eyebrow="Profil"
        description="{{ $profile->village_name }}{{ $profile->address ? ' — ' . $profile->address : '' }}"
        :crumbs="[['label' => 'Profil Desa']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 space-y-16">

        {{-- ================= VISI MISI ================= --}}
        <section data-aos="fade-up">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-[#192E03] py-3 text-center">
                        <h2 class="text-white uppercase font-bold tracking-widest text-sm">Visi</h2>
                    </div>
                    <div class="bg-white p-6 sm:p-8 text-center">
                        @if ($profile->vision)
                            <p class="italic text-slate-700 leading-relaxed whitespace-pre-line">{{ $profile->vision }}</p>
                        @else
                            <p class="text-slate-500 italic">-</p>
                        @endif
                    </div>
                </div>

                <div class="border border-slate-200 rounded-xl overflow-hidden shadow-sm">
                    <div class="bg-[#192E03] py-3 text-center">
                        <h2 class="text-white uppercase font-bold tracking-widest text-sm">Misi</h2>
                    </div>
                    <div class="bg-white p-6 sm:p-8 text-center">
                        @if ($profile->mission)
                            <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $profile->mission }}</p>
                        @else
                            <p class="text-slate-500 italic">-</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= BAGAN DESA ================= --}}
        <section data-aos="fade-up">
            <h2 class="text-2xl font-bold text-[#192E03]">Bagan Desa</h2>
            <p class="mt-1 text-sm text-[#192E03] opacity-80">Struktur Organisasi dan Tata Kerja {{ $profile->village_name }}</p>

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm font-medium text-slate-600 mb-3">Struktur Organisasi Pemerintahan Desa</p>
                    @if ($profile->org_chart_image)
                        <img src="{{ Storage::url($profile->org_chart_image) }}"
                            alt="Bagan struktur organisasi pemerintahan desa"
                            class="w-full rounded-lg border border-slate-200">
                    @else
                        <div class="w-full h-64 bg-slate-100 rounded-lg border border-slate-200 flex flex-col items-center justify-center text-center px-6">
                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-500">Bagan belum tersedia</p>
                            <p class="text-xs text-slate-500 mt-1 max-w-xs">Upload melalui menu Kelola Profil Desa di dashboard admin</p>
                        </div>
                    @endif
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-600 mb-3">Struktur Organisasi Badan Permusyawaratan Desa</p>
                    @if ($profile->bpd_chart_image)
                        <img src="{{ Storage::url($profile->bpd_chart_image) }}"
                            alt="Bagan BPD"
                            class="w-full rounded-lg border border-slate-200">
                    @else
                        <div class="w-full h-64 bg-slate-100 rounded-lg border border-slate-200 flex flex-col items-center justify-center text-center px-6">
                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-500">Bagan belum tersedia</p>
                            <p class="text-xs text-slate-500 mt-1 max-w-xs">Upload melalui menu Kelola Profil Desa di dashboard admin</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- ================= SOTK ================= --}}
        @if ($officials->isNotEmpty())
            <section data-aos="fade-up">
                <h2 class="text-2xl font-bold text-[#192E03]">SOTK</h2>
                <p class="mt-1 text-sm text-[#192E03] opacity-80">Struktur Organisasi dan Tata Kerja {{ $profile->village_name }}</p>

                <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach ($officials as $official)
                        <div class="rounded-lg overflow-hidden shadow-md">
                            @if ($official->photo)
                                <img src="{{ Storage::url($official->photo) }}"
                                    alt="{{ $official->photo_alt ?? $official->name }}"
                                    class="w-full aspect-[3/4] object-cover object-top">
                            @else
                                <div class="w-full aspect-[3/4] bg-slate-200 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="bg-[#192E03] px-3 py-2">
                                <p class="uppercase font-bold text-white text-xs truncate">{{ $official->name }}</p>
                                <p class="text-white/80 text-xs mt-0.5 truncate">{{ $official->position }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-end">
                    <a href="{{ route('aparatur.index') }}"
                        class="text-sm text-[#192E03] font-medium hover:underline flex items-center gap-1 transition">
                        Lihat Struktur Lebih Lengkap
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </section>
        @endif

        {{-- ================= SEJARAH DESA ================= --}}
        <section data-aos="fade-up">
            <h2 class="text-2xl font-bold text-[#192E03]">Sejarah {{ $profile->village_name }}</h2>

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    @if ($profile->cover_image)
                        <img src="{{ Storage::url($profile->cover_image) }}"
                            alt="{{ $profile->cover_image_alt ?? 'Gambar ' . $profile->village_name }}"
                            class="w-full h-64 object-cover rounded-2xl shadow-md">
                    @else
                        <div class="w-full h-64 rounded-2xl bg-gradient-to-br from-[#192E03]/15 to-[#192E03]/5 flex items-center justify-center">
                            <svg class="w-14 h-14 text-[#192E03]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div>
                    @if ($profile->history)
                        <p class="text-slate-700 leading-relaxed whitespace-pre-line">{{ $profile->history }}</p>
                    @else
                        <p class="text-slate-500">Sejarah desa belum tersedia.</p>
                    @endif
                </div>
            </div>
        </section>

        {{-- ================= POTENSI DESA ================= --}}
        <section data-aos="fade-up">
            <h2 class="text-2xl font-bold text-[#192E03]">Potensi Desa</h2>
            <p class="mt-1 text-sm text-[#192E03] opacity-80">Kekayaan dan potensi unggulan {{ $profile->village_name }}</p>

            @if ($potentials->isEmpty())
                <p class="mt-6 text-slate-500">Belum ada data potensi desa.</p>
            @else
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($potentials as $potential)
                        <a href="{{ route('potensi.show', $potential) }}"
                            class="group rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col">
                            <div class="relative">
                                @if ($potential->photo)
                                    <img src="{{ Storage::url($potential->photo) }}"
                                        alt="{{ $potential->photo_alt ?? $potential->name }}"
                                        class="w-full h-44 object-cover">
                                @else
                                    <div class="w-full h-44 bg-gradient-to-br from-[#192E03]/10 to-slate-100 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                                        </svg>
                                    </div>
                                @endif
                                @if ($potential->category)
                                    <span class="absolute top-3 left-3 bg-[#192E03] text-white text-xs px-2 py-0.5 rounded-full shadow-sm">
                                        {{ $potential->category }}
                                    </span>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="font-semibold text-[#192E03]">{{ $potential->name }}</h3>
                                @if ($potential->description)
                                    <p class="mt-2 text-sm text-slate-600 line-clamp-2 leading-relaxed">{{ $potential->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-end">
                    <a href="{{ route('potensi.index') }}"
                        class="text-sm text-[#192E03] font-medium hover:underline flex items-center gap-1 transition">
                        Lihat Semua Potensi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @endif
        </section>

        {{-- ================= PETA LOKASI DESA ================= --}}
        <section data-aos="fade-up">
            <h2 class="text-2xl font-bold text-[#192E03]">Peta Lokasi Desa</h2>

            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#192E03] mb-4">Batas Desa</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Utara</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $profile->border_north ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Timur</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $profile->border_east ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Selatan</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $profile->border_south ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Barat</p>
                            <p class="text-sm font-medium text-slate-800 mt-0.5">{{ $profile->border_west ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 my-5"></div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Luas Desa</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">
                                {{ $profile->area_size ? number_format($profile->area_size, 2, ',', '.') . ' m²' : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Jumlah Penduduk</p>
                            <p class="text-sm font-semibold text-slate-800 mt-0.5">
                                {{ $profile->population ? number_format($profile->population, 0, ',', '.') . ' Jiwa' : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    @if ($profile->map_embed)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm h-80">
                            {!! $profile->map_embed !!}
                        </div>
                    @else
                        <div class="h-80 rounded-2xl bg-slate-100 border border-slate-200 flex flex-col items-center justify-center text-center px-6">
                            <svg class="w-14 h-14 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-sm font-medium text-slate-500">Peta belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</x-layouts.public>
