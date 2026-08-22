<x-layouts.public title="Berita">
    <x-public-page-header title="Berita Desa"
        eyebrow="Kabar Desa"
        description="Informasi terkini seputar kegiatan, pembangunan, dan layanan Desa Cibulakan."
        :crumbs="[['label' => 'Berita']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        @if ($newsList->isEmpty())
            <p class="text-slate-500 text-center">Belum ada berita yang diterbitkan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($newsList as $news)
                    <a href="{{ route('berita.show', $news->slug) }}"
                        data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                        class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col">
                        <div class="relative overflow-hidden aspect-video">
                            @if ($news->thumbnail)
                                <img src="{{ Storage::url($news->thumbnail) }}"
                                    alt="{{ $news->thumbnail_alt ?? $news->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-[#192E03] text-white text-[11px] font-semibold shadow-sm">Berita</span>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <p class="text-xs text-[#192E03]/70 inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $news->published_at?->translatedFormat('d F Y') }}
                            </p>
                            <h3 class="font-bold text-[#192E03] mt-2 line-clamp-2 leading-snug group-hover:text-[#192E03] transition">{{ $news->title }}</h3>
                            <span class="mt-auto pt-4 text-sm font-semibold text-[#192E03] inline-flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $newsList->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
