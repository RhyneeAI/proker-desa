<x-layouts.public title="Aparatur Desa">
    <x-public-page-header title="Aparatur Desa"
        eyebrow="Struktur Organisasi"
        description="Perangkat desa yang melayani dan mengabdi untuk masyarakat {{ $profile?->village_name ?? 'Desa Cibulakan' }}."
        :crumbs="[['label' => 'Aparatur']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Bagan Struktur --}}
        @if ($profile?->org_chart_image)
            <section class="mb-14" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-[#192E03]">Bagan Struktur Organisasi</h2>
                <p class="mt-1 text-sm text-[#192E03] opacity-80">Struktur Organisasi dan Tata Kerja {{ $profile->village_name }}</p>
                <div class="mt-6 rounded-xl border border-slate-200 overflow-hidden shadow-sm bg-slate-50">
                    <img src="{{ Storage::url($profile->org_chart_image) }}"
                        alt="Bagan struktur organisasi"
                        class="w-full h-[480px] object-contain">
                </div>
            </section>
        @endif

        {{-- Daftar Perangkat --}}
        @if ($officials->isEmpty())
            <p class="text-slate-500 text-center">Data aparatur belum tersedia.</p>
        @else
            <section data-aos="fade-up">
                <h2 class="text-2xl font-bold text-[#192E03]">Perangkat Desa</h2>
                <p class="mt-1 text-sm text-[#192E03] opacity-80">Daftar perangkat {{ $profile?->village_name ?? 'desa' }}</p>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($officials as $official)
                        <x-official-card :official="$official" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.public>
