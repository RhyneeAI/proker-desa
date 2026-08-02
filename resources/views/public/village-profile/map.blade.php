<x-layouts.public title="Peta Desa">

    {{-- ================= PAGE HEADER ================= --}}
    <x-public-page-header title="Peta Desa"
        eyebrow="Lokasi & Wilayah"
        description="Lokasi, wilayah, dan titik penting {{ $profile->village_name }}."
        :crumbs="[['label' => 'Peta Desa']]" />

    @php
        $mapUmkms = $umkms->filter(fn ($u) => $u->latitude && $u->longitude);
        $mapFacilities = $facilities->filter(fn ($f) => $f->latitude && $f->longitude);
        $mapWisatas = $wisatas->filter(fn ($w) => $w->latitude && $w->longitude);
        $mapWaterPoints = $waterPoints->filter(fn ($wp) => $wp->recommend_latitude && $wp->recommend_longitude);

        $imgUrl = function (?string $file, string $seed) {
            return $file && Storage::disk('public')->exists($file)
                ? Storage::url($file)
                : 'https://picsum.photos/seed/' . $seed . '/400/300';
        };
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- ================= INFO DESA ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm" data-aos="fade-up">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-500">Nama Desa</p>
                <p class="mt-1 text-lg font-bold text-[#192E03]">{{ $profile->village_name }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $profile->address ?? '-' }}</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm" data-aos="fade-up" data-aos-delay="50">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-500">Luas Wilayah</p>
                <p class="mt-1 text-lg font-bold text-[#192E03]">
                    {{ $profile->area_size ? number_format($profile->area_size, 2, ',', '.') . ' km²' : '-' }}
                </p>
                <p class="text-xs text-slate-500 mt-1">Batas: {{ collect([$profile->border_north, $profile->border_south, $profile->border_east, $profile->border_west])->filter()->implode(', ') ?: '-' }}</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-500">Jumlah Penduduk</p>
                <p class="mt-1 text-lg font-bold text-[#192E03]">
                    {{ $profile->population ? number_format($profile->population, 0, ',', '.') . ' jiwa' : '-' }}
                </p>
                <p class="text-xs text-slate-500 mt-1">Data profil desa</p>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm" data-aos="fade-up" data-aos-delay="150">
                <p class="text-[11px] font-semibold uppercase tracking-widest text-slate-500">Titik pada Peta</p>
                <p class="mt-1 text-lg font-bold text-[#192E03]">
                    {{ $mapUmkms->count() + $mapFacilities->count() + $mapWisatas->count() + $mapWaterPoints->count() }}
                </p>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    @foreach ([
                        ['label' => 'UMKM', 'n' => $mapUmkms->count(), 'c' => '#059669'],
                        ['label' => 'Fasilitas', 'n' => $mapFacilities->count(), 'c' => '#d97706'],
                        ['label' => 'Wisata', 'n' => $mapWisatas->count(), 'c' => '#7c3aed'],
                        ['label' => 'Titik Air', 'n' => $mapWaterPoints->count(), 'c' => '#2563eb'],
                    ] as $t)
                        <span class="inline-flex items-center gap-1 text-[11px] font-medium text-slate-600">
                            <span class="w-2 h-2 rounded-full" style="background:{{ $t['c'] }}"></span>
                            {{ $t['label'] }} {{ $t['n'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ================= PETA BESAR ================= --}}
        <div class="rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-12" data-aos="fade-up">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 bg-white">
                <h2 class="text-lg font-bold text-[#192E03]">Peta Wilayah {{ $profile->village_name }}</h2>
                <span class="hidden sm:block text-xs text-slate-500">Geser peta atau klik titik untuk melihat detail</span>
            </div>

            @if ($mapUmkms->isNotEmpty() || $mapFacilities->isNotEmpty() || $mapWisatas->isNotEmpty() || $mapWaterPoints->isNotEmpty())
                <x-interactive-map :umkms="$umkms" :facilities="$facilities" :wisatas="$wisatas" :water-points="$waterPoints" center-label="{{ $profile->village_name }}" height="h-[480px] lg:h-[600px]" />
            @else
                <div class="h-[480px] lg:h-[600px] bg-slate-50 flex flex-col items-center justify-center text-center px-6">
                    <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <p class="text-lg font-bold text-slate-700">Peta belum tersedia</p>
                    <p class="text-sm text-slate-500 mt-1.5 max-w-md">Admin dapat menambahkan titik melalui dashboard.</p>
                    @auth
                        <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                            <a href="{{ route('admin.umkm.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                Tambah UMKM
                            </a>
                            <a href="{{ route('admin.titik-air.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                Tambah Titik Air
                            </a>
                        </div>
                    @endauth
                </div>
            @endif
        </div>

        {{-- ================= DAFTAR TITIK PETA ================= --}}
        @php
            $airItems = $waterPoints->map(fn ($p) => [
                'name' => $p->name,
                'col1' => $p->direction ?? '-',
                'desc' => $p->description,
                'address' => $p->address,
                'coord' => $p->recommend_latitude . ', ' . $p->recommend_longitude,
                'photo' => $imgUrl($p->documentation_photo, 'titik-air-' . $p->id),
                'alt' => $p->name,
            ])->values()->toArray();

            $wisataItems = $wisatas->map(fn ($p) => [
                'name' => $p->name,
                'col1' => $p->category ?? '-',
                'col2' => $p->opening_hours ?? '-',
                'desc' => $p->description,
                'address' => $p->address,
                'extra' => $p->ticket_price ?? '-',
                'coord' => $p->latitude . ', ' . $p->longitude,
                'photo' => $imgUrl($p->photo, 'wisata-' . $p->id),
                'alt' => $p->photo_alt ?? $p->name,
            ])->values()->toArray();

            $umkmItems = $umkms->map(fn ($p) => [
                'name' => $p->name,
                'col1' => $p->category ?? '-',
                'col2' => $p->phone ?? '-',
                'desc' => $p->description,
                'address' => $p->address,
                'extra' => $p->owner_name ?? '-',
                'coord' => $p->latitude . ', ' . $p->longitude,
                'photo' => $imgUrl($p->photo, 'umkm-' . $p->id),
                'alt' => $p->photo_alt ?? $p->name,
            ])->values()->toArray();

            $fasilitasItems = $facilities->map(fn ($p) => [
                'name' => $p->name,
                'col1' => $p->address ?? '-',
                'desc' => $p->description,
                'coord' => $p->latitude . ', ' . $p->longitude,
                'photo' => $imgUrl($p->photo, 'fasilitas-' . $p->id),
                'alt' => $p->photo_alt ?? $p->name,
            ])->values()->toArray();
        @endphp

        <section class="space-y-10 mt-16">
            <div class="text-center" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#192E03]">Daftar Titik Peta</h2>
                <p class="mt-2 text-sm text-slate-500 max-w-xl mx-auto">Klik nama bagian untuk membuka tabel, lalu klik baris untuk melihat detail tiap titik.</p>
            </div>

            {{-- Section: Titik Air --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up"
                x-data="{
                    open: false,
                    page: 1,
                    per: 5,
                    detail: null,
                    items: {{ Js::from($airItems) }},
                    get pages() { return Math.max(1, Math.ceil(this.items.length / this.per)) },
                    get rows() { return this.items.slice((this.page - 1) * this.per, this.page * this.per) },
                    setPer(p) { this.per = p; this.page = 1; this.detail = null },
                }">
                <button type="button" @click="open = !open"
                    class="w-full flex items-center gap-3 px-5 py-4 hover:bg-slate-50 transition text-left">
                    <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#2563eb"></span>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-800">Titik Air <span class="text-slate-400 font-medium">({{ $waterPoints->count() }})</span></h3>
                        <p class="text-xs text-slate-500 mt-0.5">Sumber dan sarana air bersih yang tersedia di desa.</p>
                    </div>
                    <svg x-show="!open" class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    <svg x-show="open" x-cloak class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>

                <div x-show="open" x-cloak>
                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200 bg-slate-50/70">
                        <span class="text-xs text-slate-500">Tampilkan per halaman:</span>
                        <div class="flex gap-1.5">
                            <template x-for="opt in [5,10,25,50]" :key="opt">
                                <button @click="setPer(opt)" x-text="opt"
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg transition"
                                    :class="per === opt ? 'bg-[#192E03] text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-[#192E03]/40'"></button>
                            </template>
                        </div>
                    </div>

                    <div class="hidden md:grid grid-cols-[3rem_1fr_10rem_2rem] gap-2 px-5 py-2.5 border-t border-slate-200 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <span>No</span><span>Nama Titik</span><span>Arah Lintasan</span><span></span>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <template x-for="(row, i) in rows" :key="row.name + i">
                            <div>
                                <div @click="detail = detail === i ? null : i"
                                    class="px-5 py-3 grid grid-cols-1 md:grid-cols-[3rem_1fr_10rem_2rem] md:gap-2 gap-1 items-center cursor-pointer hover:bg-slate-50 transition">
                                    <span class="text-xs text-slate-400 md:block hidden" x-text="(page - 1) * per + i + 1"></span>
                                    <p class="font-medium text-slate-800" x-text="row.name"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col1"></p>
                                    <span class="text-right text-slate-400">
                                        <svg x-show="detail !== i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        <svg x-show="detail === i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </span>
                                </div>
                                <div x-show="detail === i" x-cloak class="px-5 py-4 bg-slate-50/70 border-t border-slate-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-[176px_1fr] gap-4">
                                        <img :src="row.photo" :alt="row.alt" loading="lazy"
                                            class="w-full sm:w-44 h-28 sm:h-32 object-cover rounded-lg border border-slate-200">
                                        <div class="space-y-2 text-sm">
                                            <p class="text-slate-600 leading-relaxed" x-show="row.desc" x-text="row.desc"></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> <span x-text="row.address ?? '-'"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> <span x-text="row.coord"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <p x-show="!items.length" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data.</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200">
                        <p class="text-xs text-slate-500" x-text="'Menampilkan ' + ((page - 1) * per + 1) + '–' + Math.min(page * per, items.length) + ' dari ' + items.length + ' data'"></p>
                        <div class="flex items-center gap-2">
                            <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">‹ Sebelumnya</button>
                            <span class="text-xs text-slate-500" x-text="'Halaman ' + page + ' dari ' + pages"></span>
                            <button @click="page = Math.min(pages, page + 1)" :disabled="page === pages"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">Berikutnya ›</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Wisata --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up"
                x-data="{
                    open: false,
                    page: 1,
                    per: 5,
                    detail: null,
                    items: {{ Js::from($wisataItems) }},
                    get pages() { return Math.max(1, Math.ceil(this.items.length / this.per)) },
                    get rows() { return this.items.slice((this.page - 1) * this.per, this.page * this.per) },
                    setPer(p) { this.per = p; this.page = 1; this.detail = null },
                }">
                <button type="button" @click="open = !open"
                    class="w-full flex items-center gap-3 px-5 py-4 hover:bg-slate-50 transition text-left">
                    <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#7c3aed"></span>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-800">Wisata <span class="text-slate-400 font-medium">({{ $wisatas->count() }})</span></h3>
                        <p class="text-xs text-slate-500 mt-0.5">Destinasi wisata dan tempat menarik di desa.</p>
                    </div>
                    <svg x-show="!open" class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    <svg x-show="open" x-cloak class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>

                <div x-show="open" x-cloak>
                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200 bg-slate-50/70">
                        <span class="text-xs text-slate-500">Tampilkan per halaman:</span>
                        <div class="flex gap-1.5">
                            <template x-for="opt in [5,10,25,50]" :key="opt">
                                <button @click="setPer(opt)" x-text="opt"
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg transition"
                                    :class="per === opt ? 'bg-[#192E03] text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-[#192E03]/40'"></button>
                            </template>
                        </div>
                    </div>

                    <div class="hidden md:grid grid-cols-[3rem_1fr_7rem_8rem_2rem] gap-2 px-5 py-2.5 border-t border-slate-200 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <span>No</span><span>Nama Wisata</span><span>Kategori</span><span>Jam Buka</span><span></span>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <template x-for="(row, i) in rows" :key="row.name + i">
                            <div>
                                <div @click="detail = detail === i ? null : i"
                                    class="px-5 py-3 grid grid-cols-1 md:grid-cols-[3rem_1fr_7rem_8rem_2rem] md:gap-2 gap-1 items-center cursor-pointer hover:bg-slate-50 transition">
                                    <span class="text-xs text-slate-400 md:block hidden" x-text="(page - 1) * per + i + 1"></span>
                                    <p class="font-medium text-slate-800" x-text="row.name"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col1"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col2"></p>
                                    <span class="text-right text-slate-400">
                                        <svg x-show="detail !== i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        <svg x-show="detail === i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </span>
                                </div>
                                <div x-show="detail === i" x-cloak class="px-5 py-4 bg-slate-50/70 border-t border-slate-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-[176px_1fr] gap-4">
                                        <img :src="row.photo" :alt="row.alt" loading="lazy"
                                            class="w-full sm:w-44 h-28 sm:h-32 object-cover rounded-lg border border-slate-200">
                                        <div class="space-y-2 text-sm">
                                            <p class="text-slate-600 leading-relaxed" x-show="row.desc" x-text="row.desc"></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> <span x-text="row.address ?? '-'"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Harga Tiket:</span> <span x-text="row.extra"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> <span x-text="row.coord"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <p x-show="!items.length" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data.</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200">
                        <p class="text-xs text-slate-500" x-text="'Menampilkan ' + ((page - 1) * per + 1) + '–' + Math.min(page * per, items.length) + ' dari ' + items.length + ' data'"></p>
                        <div class="flex items-center gap-2">
                            <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">‹ Sebelumnya</button>
                            <span class="text-xs text-slate-500" x-text="'Halaman ' + page + ' dari ' + pages"></span>
                            <button @click="page = Math.min(pages, page + 1)" :disabled="page === pages"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">Berikutnya ›</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: UMKM --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up"
                x-data="{
                    open: false,
                    page: 1,
                    per: 5,
                    detail: null,
                    items: {{ Js::from($umkmItems) }},
                    get pages() { return Math.max(1, Math.ceil(this.items.length / this.per)) },
                    get rows() { return this.items.slice((this.page - 1) * this.per, this.page * this.per) },
                    setPer(p) { this.per = p; this.page = 1; this.detail = null },
                }">
                <button type="button" @click="open = !open"
                    class="w-full flex items-center gap-3 px-5 py-4 hover:bg-slate-50 transition text-left">
                    <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#059669"></span>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-800">UMKM <span class="text-slate-400 font-medium">({{ $umkms->count() }})</span></h3>
                        <p class="text-xs text-slate-500 mt-0.5">Usaha mikro, kecil, dan menengah milik warga desa.</p>
                    </div>
                    <svg x-show="!open" class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    <svg x-show="open" x-cloak class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>

                <div x-show="open" x-cloak>
                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200 bg-slate-50/70">
                        <span class="text-xs text-slate-500">Tampilkan per halaman:</span>
                        <div class="flex gap-1.5">
                            <template x-for="opt in [5,10,25,50]" :key="opt">
                                <button @click="setPer(opt)" x-text="opt"
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg transition"
                                    :class="per === opt ? 'bg-[#192E03] text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-[#192E03]/40'"></button>
                            </template>
                        </div>
                    </div>

                    <div class="hidden md:grid grid-cols-[3rem_1fr_8rem_9rem_2rem] gap-2 px-5 py-2.5 border-t border-slate-200 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <span>No</span><span>Nama Usaha</span><span>Kategori</span><span>Telepon</span><span></span>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <template x-for="(row, i) in rows" :key="row.name + i">
                            <div>
                                <div @click="detail = detail === i ? null : i"
                                    class="px-5 py-3 grid grid-cols-1 md:grid-cols-[3rem_1fr_8rem_9rem_2rem] md:gap-2 gap-1 items-center cursor-pointer hover:bg-slate-50 transition">
                                    <span class="text-xs text-slate-400 md:block hidden" x-text="(page - 1) * per + i + 1"></span>
                                    <p class="font-medium text-slate-800" x-text="row.name"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col1"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col2"></p>
                                    <span class="text-right text-slate-400">
                                        <svg x-show="detail !== i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        <svg x-show="detail === i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </span>
                                </div>
                                <div x-show="detail === i" x-cloak class="px-5 py-4 bg-slate-50/70 border-t border-slate-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-[176px_1fr] gap-4">
                                        <img :src="row.photo" :alt="row.alt" loading="lazy"
                                            class="w-full sm:w-44 h-28 sm:h-32 object-cover rounded-lg border border-slate-200">
                                        <div class="space-y-2 text-sm">
                                            <p class="text-slate-600 leading-relaxed" x-show="row.desc" x-text="row.desc"></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> <span x-text="row.address ?? '-'"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Pemilik:</span> <span x-text="row.extra"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> <span x-text="row.coord"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <p x-show="!items.length" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data.</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200">
                        <p class="text-xs text-slate-500" x-text="'Menampilkan ' + ((page - 1) * per + 1) + '–' + Math.min(page * per, items.length) + ' dari ' + items.length + ' data'"></p>
                        <div class="flex items-center gap-2">
                            <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">‹ Sebelumnya</button>
                            <span class="text-xs text-slate-500" x-text="'Halaman ' + page + ' dari ' + pages"></span>
                            <button @click="page = Math.min(pages, page + 1)" :disabled="page === pages"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">Berikutnya ›</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Fasilitas --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up"
                x-data="{
                    open: false,
                    page: 1,
                    per: 5,
                    detail: null,
                    items: {{ Js::from($fasilitasItems) }},
                    get pages() { return Math.max(1, Math.ceil(this.items.length / this.per)) },
                    get rows() { return this.items.slice((this.page - 1) * this.per, this.page * this.per) },
                    setPer(p) { this.per = p; this.page = 1; this.detail = null },
                }">
                <button type="button" @click="open = !open"
                    class="w-full flex items-center gap-3 px-5 py-4 hover:bg-slate-50 transition text-left">
                    <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#d97706"></span>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-800">Fasilitas Umum <span class="text-slate-400 font-medium">({{ $facilities->count() }})</span></h3>
                        <p class="text-xs text-slate-500 mt-0.5">Sarana dan prasarana umum yang melayani masyarakat.</p>
                    </div>
                    <svg x-show="!open" class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    <svg x-show="open" x-cloak class="w-5 h-5 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                </button>

                <div x-show="open" x-cloak>
                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200 bg-slate-50/70">
                        <span class="text-xs text-slate-500">Tampilkan per halaman:</span>
                        <div class="flex gap-1.5">
                            <template x-for="opt in [5,10,25,50]" :key="opt">
                                <button @click="setPer(opt)" x-text="opt"
                                    class="px-2.5 py-1 text-xs font-semibold rounded-lg transition"
                                    :class="per === opt ? 'bg-[#192E03] text-white' : 'bg-white text-slate-600 border border-slate-200 hover:border-[#192E03]/40'"></button>
                            </template>
                        </div>
                    </div>

                    <div class="hidden md:grid grid-cols-[3rem_1fr_1fr_2rem] gap-2 px-5 py-2.5 border-t border-slate-200 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <span>No</span><span>Nama Fasilitas</span><span>Alamat</span><span></span>
                    </div>
                    <div class="divide-y divide-slate-100">
                        <template x-for="(row, i) in rows" :key="row.name + i">
                            <div>
                                <div @click="detail = detail === i ? null : i"
                                    class="px-5 py-3 grid grid-cols-1 md:grid-cols-[3rem_1fr_1fr_2rem] md:gap-2 gap-1 items-center cursor-pointer hover:bg-slate-50 transition">
                                    <span class="text-xs text-slate-400 md:block hidden" x-text="(page - 1) * per + i + 1"></span>
                                    <p class="font-medium text-slate-800" x-text="row.name"></p>
                                    <p class="text-sm text-slate-600" x-text="row.col1"></p>
                                    <span class="text-right text-slate-400">
                                        <svg x-show="detail !== i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        <svg x-show="detail === i" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                    </span>
                                </div>
                                <div x-show="detail === i" x-cloak class="px-5 py-4 bg-slate-50/70 border-t border-slate-100">
                                    <div class="grid grid-cols-1 sm:grid-cols-[176px_1fr] gap-4">
                                        <img :src="row.photo" :alt="row.alt" loading="lazy"
                                            class="w-full sm:w-44 h-28 sm:h-32 object-cover rounded-lg border border-slate-200">
                                        <div class="space-y-2 text-sm">
                                            <p class="text-slate-600 leading-relaxed" x-show="row.desc" x-text="row.desc"></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> <span x-text="row.address ?? '-'"></span></p>
                                            <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> <span x-text="row.coord"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <p x-show="!items.length" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data.</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-2 px-5 py-3 border-t border-slate-200">
                        <p class="text-xs text-slate-500" x-text="'Menampilkan ' + ((page - 1) * per + 1) + '–' + Math.min(page * per, items.length) + ' dari ' + items.length + ' data'"></p>
                        <div class="flex items-center gap-2">
                            <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">‹ Sebelumnya</button>
                            <span class="text-xs text-slate-500" x-text="'Halaman ' + page + ' dari ' + pages"></span>
                            <button @click="page = Math.min(pages, page + 1)" :disabled="page === pages"
                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 text-slate-600 hover:border-[#192E03]/40 disabled:opacity-40 disabled:cursor-not-allowed transition">Berikutnya ›</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.public>
