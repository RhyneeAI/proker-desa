<x-layouts.public :title="$announcement->title">
    <x-public-page-header :title="$announcement->title"
        eyebrow="Pengumuman Resmi"
        :crumbs="[
            ['label' => 'Pengumuman', 'url' => route('pengumuman.index')],
            ['label' => Str::limit($announcement->title, 30)],
        ]" />

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <div class="bg-white rounded-2xl border border-slate-200 border-l-4 border-l-[#192E03] p-6 sm:p-10 shadow-sm">
            <span class="inline-flex px-2.5 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold">Pengumuman Resmi</span>

            <div class="flex flex-wrap items-center gap-3 mt-4">
                <span class="inline-flex items-center gap-1.5 text-sm text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $announcement->published_at?->translatedFormat('d F Y') }}
                </span>
                @if ($announcement->deadline)
                    <span class="text-xs px-3 py-1.5 rounded-full font-medium
                        {{ $announcement->deadline->isPast() ? 'bg-slate-100 text-slate-600' : 'bg-amber-100 text-amber-700' }}">
                        Berlaku hingga {{ $announcement->deadline->translatedFormat('d F Y') }}
                        {{ $announcement->deadline->isPast() ? '(Kedaluwarsa)' : '' }}
                    </span>
                @endif
            </div>

            <div class="mt-6 pt-6 border-t border-slate-100 text-slate-700 leading-relaxed whitespace-pre-line text-base">
                {{ $announcement->content }}
            </div>
        </div>
    </div>
</x-layouts.public>
