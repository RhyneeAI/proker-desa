<x-layouts.public title="Pengumuman">
    <x-public-page-header title="Pengumuman Desa"
        eyebrow="Informasi Resmi"
        description="Pengumuman resmi dari pemerintah desa yang perlu diketahui masyarakat."
        :crumbs="[['label' => 'Pengumuman']]" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        @if ($announcements->isEmpty())
            <p class="text-slate-500 text-center">Belum ada pengumuman.</p>
        @else
            <div class="space-y-4">
                @foreach ($announcements as $announcement)
                    <a href="{{ route('pengumuman.show', $announcement->slug) }}"
                        class="flex items-start justify-between gap-4 bg-white rounded-xl border border-slate-200 border-l-4 pl-4 sm:pl-5 pr-4 sm:pr-5 py-5 transition hover:shadow-lg hover:-translate-y-0.5 hover:border-slate-300 border-l-[#192E03] hover:border-l-[#192E03]">
                        <div class="min-w-0">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 flex-shrink-0 text-[#192E03] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5"/>
                                </svg>
                                <h3 class="font-bold text-[#192E03] break-words">{{ $announcement->title }}</h3>
                            </div>
                            <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                                {{ Str::limit(strip_tags($announcement->content), 130) }}
                            </p>
                            <p class="text-xs text-slate-500 mt-3">{{ $announcement->published_at?->translatedFormat('d F Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
