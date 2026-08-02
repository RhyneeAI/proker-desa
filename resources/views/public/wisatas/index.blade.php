<x-layouts.public title="Wisata">
    <x-public-page-header title="Wisata Desa"
        eyebrow="Wisata Desa"
        description="Jelajahi destinasi wisata menarik yang ada di desa kami."
        :crumbs="[['label' => 'Wisata']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        @if ($wisatas->isEmpty())
            <p class="text-slate-500 text-center">Belum ada data wisata.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($wisatas as $wisata)
                    <a href="{{ route('wisata.show', $wisata) }}"
                        class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            @if ($wisata->photo)
                                <img src="{{ Storage::url($wisata->photo) }}"
                                    alt="{{ $wisata->photo_alt ?? $wisata->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 15l6-6 4 4 8-8M15 5h5v5"/>
                                    </svg>
                                </div>
                            @endif
                            @if ($wisata->category)
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-[#192E03] text-white text-[11px] font-semibold shadow-sm">
                                    {{ $wisata->category }}
                                </span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-[#192E03] group-hover:text-[#192E03] transition">{{ $wisata->name }}</h3>
                            @if ($wisata->address)
                                <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $wisata->address }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $wisatas->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
