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
                        @if ($waterPoint->debit)
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Debit Air</dt>
                                <dd class="mt-1 text-slate-800">{{ $waterPoint->debit }}</dd>
                            </div>
                        @endif
                        @if ($waterPoint->direction)
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Arah Lintasan</dt>
                                <dd class="mt-1 text-slate-800">{{ $waterPoint->direction }}</dd>
                            </div>
                        @endif
                        @if ($waterPoint->recommend_depth)
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Kedalaman Rekomendasi</dt>
                                <dd class="mt-1 text-slate-800">{{ $waterPoint->recommend_depth }}</dd>
                            </div>
                        @endif
                        @if ($waterPoint->address)
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Alamat</dt>
                                <dd class="mt-1 text-slate-800">{{ $waterPoint->address }}</dd>
                            </div>
                        @endif
                    </dl>
                    @if ($waterPoint->description)
                        <p class="mt-4 text-slate-600 leading-relaxed text-sm">{{ $waterPoint->description }}</p>
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
                        <li class="flex gap-2"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span>Metode <em>Electrical Resistivity Tomography</em>: material jenuh air memiliki resistivitas rendah (warna biru–ungu), batuan kering/bedrock resistivitas tinggi (oranye–merah).</li>
                        <li class="flex gap-2"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span>Zona paling prospektif berada pada <strong>jarak 10–40 m</strong> dari titik awal lintasan, pada <strong>kedalaman ±20–50 m</strong> (resistivitas rendah &amp; konsisten).</li>
                        <li class="flex gap-2"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span>Sisi kanan lintasan (jarak 60–100 m) cenderung resistif tinggi → kurang prospektif untuk sumur bor.</li>
                        <li class="flex gap-2"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span>Zona transisi (hijau–kuning) berpotensi menyimpan air terbatas, perlu verifikasi lanjut.</li>
                        <li class="flex gap-2"><span class="text-[#3A5C0A] font-bold flex-shrink-0">•</span>Resistivitas rendah tidak selalu berarti air produktif (lempung jenuh air juga rendah); direkomendasikan verifikasi dengan data geologi atau uji bor.</li>
                    </ul>
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
