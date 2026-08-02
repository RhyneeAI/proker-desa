<x-layouts.public :title="$potential->name">

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <a href="{{ route('potensi.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1 mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Potensi Desa
        </a>

        @if ($potential->photo)
            <img src="{{ Storage::url($potential->photo) }}"
                alt="{{ $potential->photo_alt ?? $potential->name }}"
                class="w-full h-64 object-cover rounded-2xl border border-slate-200 shadow-sm">
        @endif

        <div class="mt-6">
            @if ($potential->category)
                <span class="inline-flex px-3 py-1 bg-[#192E03] text-white text-xs font-semibold rounded-full">
                    {{ $potential->category }}
                </span>
            @endif

            <h1 class="mt-3 text-2xl font-bold text-[#192E03]">{{ $potential->name }}</h1>

            @if ($potential->description)
                <p class="mt-4 text-slate-700 leading-relaxed whitespace-pre-line">{{ $potential->description }}</p>
            @endif
        </div>
    </div>
</x-layouts.public>
