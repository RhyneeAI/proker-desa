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
        $mapWaterPoints = $waterPoints->filter(fn ($wp) => $wp->latitude && $wp->longitude);

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
        <section class="space-y-8">
            <div class="text-center" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#192E03]">Daftar Titik Peta</h2>
                <p class="mt-2 text-sm text-slate-500 max-w-xl mx-auto">Klik baris pada tabel untuk melihat detail tiap titik secara dinamis.</p>
            </div>

            {{-- TITIK AIR --}}
            @if ($waterPoints->isNotEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" x-data="{ open: null }" data-aos="fade-up">
                    <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-200">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#2563eb"></span>
                        <h3 class="font-bold text-slate-800">Titik Air <span class="text-slate-400 font-medium">({{ $waterPoints->count() }})</span></h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-500 text-left border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 font-medium w-10">No</th>
                                    <th class="px-4 py-3 font-medium">Nama Titik</th>
                                    <th class="px-4 py-3 font-medium">Jenis</th>
                                    <th class="px-4 py-3 font-medium">Status</th>
                                    <th class="px-4 py-3 font-medium text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($waterPoints as $point)
                                    <tr @click="open = open === {{ $loop->index }} ? null : {{ $loop->index }}"
                                        class="cursor-pointer hover:bg-slate-50 transition">
                                        <td class="px-4 py-3 text-slate-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $point->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->category ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusClass = $point->status === 'Rusak' ? 'bg-red-100 text-red-700' : ($point->status === 'Pemeliharaan' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700');
                                            @endphp
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">{{ $point->status ?? '-' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-right text-slate-400">
                                            <svg x-show="open !== {{ $loop->index }}" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            <svg x-show="open === {{ $loop->index }}" x-cloak class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </td>
                                    </tr>
                                    <tr x-show="open === {{ $loop->index }}" x-cloak class="bg-slate-50/70">
                                        <td colspan="5" class="px-5 py-5">
                                            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-5">
                                                <img src="{{ $imgUrl($point->photo, 'titik-air-' . $point->id) }}"
                                                    alt="{{ $point->photo_alt ?? $point->name }}"
                                                    loading="lazy"
                                                    class="w-full h-40 object-cover rounded-xl border border-slate-200">
                                                <div class="space-y-2.5 text-sm">
                                                    @if ($point->description)
                                                        <p class="text-slate-600 leading-relaxed">{{ $point->description }}</p>
                                                    @endif
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> {{ $point->address ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> {{ $point->latitude }}, {{ $point->longitude }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- WISATA --}}
            @if ($wisatas->isNotEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" x-data="{ open: null }" data-aos="fade-up">
                    <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-200">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#7c3aed"></span>
                        <h3 class="font-bold text-slate-800">Wisata <span class="text-slate-400 font-medium">({{ $wisatas->count() }})</span></h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-500 text-left border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 font-medium w-10">No</th>
                                    <th class="px-4 py-3 font-medium">Nama Wisata</th>
                                    <th class="px-4 py-3 font-medium">Kategori</th>
                                    <th class="px-4 py-3 font-medium">Jam Buka</th>
                                    <th class="px-4 py-3 font-medium text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($wisatas as $point)
                                    <tr @click="open = open === {{ $loop->index }} ? null : {{ $loop->index }}"
                                        class="cursor-pointer hover:bg-slate-50 transition">
                                        <td class="px-4 py-3 text-slate-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $point->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->category ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->opening_hours ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right text-slate-400">
                                            <svg x-show="open !== {{ $loop->index }}" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            <svg x-show="open === {{ $loop->index }}" x-cloak class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </td>
                                    </tr>
                                    <tr x-show="open === {{ $loop->index }}" x-cloak class="bg-slate-50/70">
                                        <td colspan="5" class="px-5 py-5">
                                            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-5">
                                                <img src="{{ $imgUrl($point->photo, 'wisata-' . $point->id) }}"
                                                    alt="{{ $point->photo_alt ?? $point->name }}"
                                                    loading="lazy"
                                                    class="w-full h-40 object-cover rounded-xl border border-slate-200">
                                                <div class="space-y-2.5 text-sm">
                                                    @if ($point->description)
                                                        <p class="text-slate-600 leading-relaxed">{{ $point->description }}</p>
                                                    @endif
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> {{ $point->address ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Harga Tiket:</span> {{ $point->ticket_price ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> {{ $point->latitude }}, {{ $point->longitude }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- UMKM --}}
            @if ($umkms->isNotEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" x-data="{ open: null }" data-aos="fade-up">
                    <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-200">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#059669"></span>
                        <h3 class="font-bold text-slate-800">UMKM <span class="text-slate-400 font-medium">({{ $umkms->count() }})</span></h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-500 text-left border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 font-medium w-10">No</th>
                                    <th class="px-4 py-3 font-medium">Nama Usaha</th>
                                    <th class="px-4 py-3 font-medium">Kategori</th>
                                    <th class="px-4 py-3 font-medium">Telepon</th>
                                    <th class="px-4 py-3 font-medium text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($umkms as $point)
                                    <tr @click="open = open === {{ $loop->index }} ? null : {{ $loop->index }}"
                                        class="cursor-pointer hover:bg-slate-50 transition">
                                        <td class="px-4 py-3 text-slate-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $point->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->category ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->phone ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right text-slate-400">
                                            <svg x-show="open !== {{ $loop->index }}" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            <svg x-show="open === {{ $loop->index }}" x-cloak class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </td>
                                    </tr>
                                    <tr x-show="open === {{ $loop->index }}" x-cloak class="bg-slate-50/70">
                                        <td colspan="5" class="px-5 py-5">
                                            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-5">
                                                <img src="{{ $imgUrl($point->photo, 'umkm-' . $point->id) }}"
                                                    alt="{{ $point->photo_alt ?? $point->name }}"
                                                    loading="lazy"
                                                    class="w-full h-40 object-cover rounded-xl border border-slate-200">
                                                <div class="space-y-2.5 text-sm">
                                                    @if ($point->description)
                                                        <p class="text-slate-600 leading-relaxed">{{ $point->description }}</p>
                                                    @endif
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Pemilik:</span> {{ $point->owner_name ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> {{ $point->address ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> {{ $point->latitude }}, {{ $point->longitude }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- FASILITAS --}}
            @if ($facilities->isNotEmpty())
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden" x-data="{ open: null }" data-aos="fade-up">
                    <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-200">
                        <span class="w-3 h-3 rounded-full flex-shrink-0" style="background:#d97706"></span>
                        <h3 class="font-bold text-slate-800">Fasilitas Umum <span class="text-slate-400 font-medium">({{ $facilities->count() }})</span></h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-500 text-left border-b border-slate-200">
                                <tr>
                                    <th class="px-4 py-3 font-medium w-10">No</th>
                                    <th class="px-4 py-3 font-medium">Nama Fasilitas</th>
                                    <th class="px-4 py-3 font-medium">Alamat</th>
                                    <th class="px-4 py-3 font-medium text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($facilities as $point)
                                    <tr @click="open = open === {{ $loop->index }} ? null : {{ $loop->index }}"
                                        class="cursor-pointer hover:bg-slate-50 transition">
                                        <td class="px-4 py-3 text-slate-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-800">{{ $point->name }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $point->address ?? '-' }}</td>
                                        <td class="px-4 py-3 text-right text-slate-400">
                                            <svg x-show="open !== {{ $loop->index }}" class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            <svg x-show="open === {{ $loop->index }}" x-cloak class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                        </td>
                                    </tr>
                                    <tr x-show="open === {{ $loop->index }}" x-cloak class="bg-slate-50/70">
                                        <td colspan="4" class="px-5 py-5">
                                            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-5">
                                                <img src="{{ $imgUrl($point->photo, 'fasilitas-' . $point->id) }}"
                                                    alt="{{ $point->photo_alt ?? $point->name }}"
                                                    loading="lazy"
                                                    class="w-full h-40 object-cover rounded-xl border border-slate-200">
                                                <div class="space-y-2.5 text-sm">
                                                    @if ($point->description)
                                                        <p class="text-slate-600 leading-relaxed">{{ $point->description }}</p>
                                                    @endif
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Alamat:</span> {{ $point->address ?? '-' }}</p>
                                                    <p class="text-slate-500"><span class="font-semibold text-slate-700">Koordinat:</span> {{ $point->latitude }}, {{ $point->longitude }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </section>
    </div>
</x-layouts.public>
