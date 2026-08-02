<x-layouts.public :title="$news->title" :meta-description="Str::limit(strip_tags($news->content), 160)">
    <x-public-page-header :title="$news->title"
        eyebrow="Berita Desa"
        :crumbs="[
            ['label' => 'Berita', 'url' => route('berita.index')],
            ['label' => Str::limit($news->title, 30)],
        ]" />

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Meta --}}
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $news->published_at?->translatedFormat('d F Y') }}
            </span>
            @if ($news->user)
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    {{ $news->user->name }}
                </span>
            @endif
        </div>

        {{-- Gambar Utama --}}
        @if ($news->thumbnail)
            <div class="mt-6 rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                <img src="{{ Storage::url($news->thumbnail) }}"
                    alt="{{ $news->thumbnail_alt ?? $news->title }}"
                    class="w-full h-64 sm:h-80 object-cover">
            </div>
        @endif

        {{-- Isi --}}
        <article class="mt-8 text-slate-700 leading-relaxed whitespace-pre-line text-base sm:text-lg">
            {{ $news->content }}
        </article>

        {{-- Berita Terkait --}}
        @if ($relatedNews->isNotEmpty())
            <div class="mt-16 pt-10 border-t border-slate-200">
                <h2 class="text-xl font-bold text-[#192E03] mb-6">Berita Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach ($relatedNews as $related)
                        <a href="{{ route('berita.show', $related->slug) }}"
                            class="group bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition">
                            @if ($related->thumbnail)
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ Storage::url($related->thumbnail) }}"
                                        alt="{{ $related->thumbnail_alt ?? $related->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                            @else
                                <div class="aspect-video bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <p class="text-xs text-[#192E03]/70">{{ $related->published_at?->translatedFormat('d F Y') }}</p>
                                <p class="text-sm font-semibold text-[#192E03] mt-1 line-clamp-2 group-hover:text-[#192E03] transition">{{ $related->title }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layouts.public>
