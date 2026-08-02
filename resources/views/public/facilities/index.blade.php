<x-layouts.public title="Fasilitas Umum">
    <x-public-page-header title="Fasilitas Umum"
        eyebrow="Sarana & Prasarana"
        description="Sarana dan prasarana yang tersedia untuk masyarakat Desa Cibulakan."
        :crumbs="[['label' => 'Fasilitas']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        @if ($facilities->isEmpty())
            <p class="text-slate-500 text-center">Belum ada data fasilitas.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($facilities as $facility)
                    <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                        class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            @if ($facility->photo)
                                <img src="{{ Storage::url($facility->photo) }}"
                                    alt="{{ $facility->photo_alt ?? $facility->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-[#192E03] group-hover:text-[#192E03] transition">{{ $facility->name }}</h3>
                            @if ($facility->address)
                                <p class="text-xs text-slate-500 mt-1.5 inline-flex items-start gap-1">
                                    <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $facility->address }}
                                </p>
                            @endif
                            @if ($facility->description)
                                <p class="text-sm text-slate-600 mt-2 line-clamp-2">{{ $facility->description }}</p>
                            @endif
                            @if ($facility->latitude && $facility->longitude)
                                <a href="https://www.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}"
                                    target="_blank"
                                    class="mt-auto pt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-[#192E03] hover:text-[#192E03] transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    Lihat di Peta
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $facilities->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
