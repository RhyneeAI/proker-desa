<x-layouts.public :title="$waterPoint->name">
    <x-public-page-header :title="$waterPoint->name"
        eyebrow="Titik Air"
        description="{{ $waterPoint->description ?? 'Informasi titik air Desa Cibulakan.' }}"
        :crumbs="[
            ['label' => 'Peta Desa', 'url' => route('peta-desa.show')],
            ['label' => Str::limit($waterPoint->name, 30)],
        ]" />

    @php
        $docs = collect($waterPoint->documentation_photos ?? []);
        $plots = collect($waterPoint->interpretation_photos ?? []);
        $plot0 = $plots->first();
        $plotOthers = $plots->slice(1)->values();

        $imgUrl = fn ($file) => $file && Storage::disk('public')->exists($file) ? Storage::url($file) : null;
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Info Utama --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm" data-aos="fade-up">
                    <h2 class="text-lg font-bold text-[#192E03] mb-4">Informasi Titik Air</h2>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Debit Air</dt>
                            <dd class="mt-1 text-slate-800">{{ $waterPoint->debit ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Arah Lintasan</dt>
                            <dd class="mt-1 text-slate-800">{{ $waterPoint->direction ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kedalaman Rekomendasi</dt>
                            <dd class="mt-1 text-slate-800">{{ $waterPoint->recommend_depth ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Alamat</dt>
                            <dd class="mt-1 text-slate-800">{{ $waterPoint->address ?? '-' }}</dd>
                        </div>
                    </dl>
                    @if ($waterPoint->description)
                        <p class="mt-4 text-slate-600 leading-relaxed text-sm">{{ $waterPoint->description }}</p>
                    @else
                        <p class="mt-4 text-slate-400 italic text-sm">Belum ada deskripsi untuk titik air ini.</p>
                    @endif
                </div>

                @if ($docs->isNotEmpty())
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm" data-aos="fade-up">
                        <h2 class="text-lg font-bold text-[#192E03] mb-4">Foto Dokumentasi</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach ($docs as $photo)
                                @if ($imgUrl($photo))
                                    <a href="{{ $imgUrl($photo) }}" data-lightbox="docs-{{ $waterPoint->id }}"
                                        class="rounded-xl overflow-hidden border border-slate-200 group">
                                        <img src="{{ $imgUrl($photo) }}" alt="{{ $waterPoint->name }}"
                                            loading="lazy" class="w-full h-32 object-cover group-hover:scale-105 transition duration-300">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Plot Interpretasi --}}
            <div class="lg:col-span-1 space-y-6">
                @if ($plot0 && $imgUrl($plot0))
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm" data-aos="fade-up">
                        <h2 class="text-lg font-bold text-[#192E03] mb-1">Plot Interpretasi Geolistrik</h2>
                        <p class="text-xs text-slate-500 mb-4">Hasil survei alat AIDU — Konfigurasi 0.</p>
                        <a href="{{ $imgUrl($plot0) }}" data-lightbox="plots-{{ $waterPoint->id }}">
                            <img src="{{ $imgUrl($plot0) }}" alt="Plot interpretasi Konfigurasi 0"
                                loading="lazy" class="w-full rounded-xl border border-slate-200">
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm" data-aos="fade-up">
                        <h2 class="text-lg font-bold text-[#192E03] mb-1">Plot Interpretasi Geolistrik</h2>
                        <p class="text-xs text-slate-500 mb-4">Hasil survei alat AIDU — Konfigurasi 0.</p>
                        <div class="rounded-xl border-2 border-dashed border-slate-200 h-40 flex flex-col items-center justify-center text-center px-4">
                            <i class="ti ti-photo-off text-slate-300" style="font-size:2rem"></i>
                            <p class="text-sm text-slate-400 mt-2">Plot interpretasi belum diunggah.</p>
                        </div>
                    </div>
                @endif

                @if ($plotOthers->isNotEmpty())
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm" data-aos="fade-up">
                        <h3 class="text-sm font-bold text-[#192E03] mb-3">Konfigurasi Lainnya</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($plotOthers as $photo)
                                @if ($imgUrl($photo))
                                    <a href="{{ $imgUrl($photo) }}" data-lightbox="plots-{{ $waterPoint->id }}">
                                        <img src="{{ $imgUrl($photo) }}" alt="Plot interpretasi"
                                            loading="lazy" class="w-full rounded-lg border border-slate-200">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Ringkasan Interpretasi --}}
                <div class="bg-[#192E03] text-white rounded-2xl p-6 shadow-sm" data-aos="fade-up">
                    <h3 class="font-bold text-sm uppercase tracking-wider mb-3">Ringkasan Interpretasi Geolistrik</h3>
                    <ul class="space-y-2.5 text-sm text-white/85">
                        <li class="flex gap-2 items-start"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span><span class="flex-1 min-w-0">Metode <em>Electrical Resistivity Tomography</em>: material jenuh air memiliki resistivitas rendah (warna biru–ungu), batuan kering/bedrock resistivitas tinggi (oranye–merah).</span></li>
                        <li class="flex gap-2 items-start"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span><span class="flex-1 min-w-0">Zona paling prospektif berada pada <strong>jarak 10–40 m</strong> dari titik awal lintasan, pada <strong>kedalaman ±20–50 m</strong> (resistivitas rendah &amp; konsisten).</span></li>
                        <li class="flex gap-2 items-start"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span><span class="flex-1 min-w-0">Sisi kanan lintasan (jarak 60–100 m) cenderung resistif tinggi → kurang prospektif untuk sumur bor.</span></li>
                        <li class="flex gap-2 items-start"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span><span class="flex-1 min-w-0">Zona transisi (hijau–kuning) berpotensi menyimpan air terbatas, perlu verifikasi lanjut.</span></li>
                        <li class="flex gap-2 items-start"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span><span class="flex-1 min-w-0">Resistivitas rendah tidak selalu berarti air produktif (lempung jenuh air juga rendah); direkomendasikan verifikasi dengan data geologi atau uji bor.</span></li>
                    </ul>

                    <h4 class="font-bold text-xs uppercase tracking-wider mt-5 mb-2 text-white/70">Legenda Warna Penampang (skala 6–50 Ωm)</h4>
                    <div class="grid grid-cols-1 gap-1.5 text-xs text-white/80">
                        @foreach ([
                            ['c' => '#4a1a7a', 'n' => 'Ungu tua', 'r' => '6–10 Ωm', 'm' => 'Paling jenuh air — kandidat akuifer'],
                            ['c' => '#1e3a8a', 'n' => 'Biru tua', 'r' => '10–14 Ωm', 'm' => 'Jenuh air kuat, akuifer dangkal'],
                            ['c' => '#3b82f6', 'n' => 'Biru muda', 'r' => '14–18 Ωm', 'm' => 'Basah, transisi zona air'],
                            ['c' => '#06b6d4', 'n' => 'Cyan', 'r' => '18–22 Ωm', 'm' => 'Cukup lembab, air mulai menurun'],
                            ['c' => '#16a34a', 'n' => 'Hijau tua', 'r' => '22–26 Ωm', 'm' => 'Lembab, campuran pasir-lempung'],
                            ['c' => '#84cc16', 'n' => 'Hijau muda', 'r' => '26–30 Ωm', 'm' => 'Sedang'],
                            ['c' => '#eab308', 'n' => 'Kuning', 'r' => '30–34 Ωm', 'm' => 'Mulai mengering, air terbatas'],
                            ['c' => '#f59e0b', 'n' => 'Oranye', 'r' => '34–42 Ωm', 'm' => 'Kering, pasir/kerikil tak jenuh'],
                            ['c' => '#dc2626', 'n' => 'Merah tua', 'r' => '42–50 Ωm', 'm' => 'Paling resistif — batuan keras/bedrock'],
                        ] as $w)
                            <div class="flex items-center gap-2">
                                <span class="inline-block w-6 h-4 rounded-sm flex-shrink-0" style="background:{{ $w['c'] }}"></span>
                                <span class="font-semibold w-20 flex-shrink-0">{{ $w['n'] }}</span>
                                <span class="text-white/60 w-16 flex-shrink-0">{{ $w['r'] }}</span>
                                <span class="text-white/75">{{ $w['m'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-[11px] text-white/50 mt-3 leading-relaxed">Catatan: warna ungu–biru (6–18 Ωm) = kandidat zona air tanah; cyan–kuning = zona transisi; oranye–merah = kering/batuan, kurang prospektif.</p>
                </div>
            </div>
        </div>

        {{-- Peta Lokasi Titik --}}
        @if ($waterPoint->recommend_latitude && $waterPoint->recommend_longitude)
            <div class="mt-10" data-aos="fade-up">
                <x-interactive-map :water-points="collect([$waterPoint])"
                    center-label="{{ $waterPoint->name }}"
                    height="h-80 lg:h-[400px]" :show-toggle="false" />
            </div>
        @endif
    </div>
</x-layouts.public>
