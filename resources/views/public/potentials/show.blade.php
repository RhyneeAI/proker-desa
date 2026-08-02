<x-layouts.public :title="$potential->name">

    <x-public-page-header :title="$potential->name"
        eyebrow="Potensi Desa"
        :crumbs="[
            ['label' => 'Potensi Desa', 'url' => route('potensi.index')],
            ['label' => Str::limit($potential->name, 30)],
        ]" />

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

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
