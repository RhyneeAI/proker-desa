<x-layouts.public title="Potensi Desa">

    {{-- ================= PAGE HEADER ================= --}}
    <section class="bg-[#192E03] pt-24 sm:pt-28 pb-10 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-white/60 mb-4 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
                <span>/</span>
                <span class="text-white">Potensi Desa</span>
            </nav>
            <h1 class="text-3xl font-bold text-white">Potensi Desa</h1>
            <p class="mt-2 text-white/80">Kekayaan dan potensi unggulan desa kami</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        @if ($potentials->isEmpty())
            <p class="text-center text-slate-500">Belum ada data potensi desa.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($potentials as $potential)
                    <a href="{{ route('potensi.show', $potential) }}"
                        class="group rounded-2xl overflow-hidden border border-slate-200 bg-white hover:shadow-md hover:-translate-y-1 transition flex flex-col">
                        <div class="relative overflow-hidden">
                            @if ($potential->photo)
                                <img src="{{ Storage::url($potential->photo) }}"
                                    alt="{{ $potential->photo_alt ?? $potential->name }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-[#192E03]/10 to-slate-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                                    </svg>
                                </div>
                            @endif
                            @if ($potential->category)
                                <span class="absolute top-3 left-3 bg-[#192E03] text-white text-xs px-2 py-0.5 rounded-full shadow-sm">
                                    {{ $potential->category }}
                                </span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="font-semibold text-slate-900">{{ $potential->name }}</h2>
                            @if ($potential->description)
                                <p class="mt-2 text-sm text-slate-600 line-clamp-2 leading-relaxed">{{ $potential->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $potentials->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
