<x-layouts.public title="UMKM">
    <x-public-page-header title="UMKM Desa"
        eyebrow="Potensi Desa"
        description="Temukan produk dan jasa unggulan dari para pelaku usaha warga desa."
        :crumbs="[['label' => 'UMKM']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Filter Kategori --}}
        @if ($categories->isNotEmpty())
            <div class="flex flex-wrap justify-center gap-2 mb-10">
                <a href="{{ route('umkm.index') }}"
                    class="px-4 py-2 text-sm font-medium rounded-full transition
                    {{ ! request('category') ? 'bg-[#192E03] text-white shadow-sm' : 'bg-white border border-slate-300 text-slate-600 hover:border-[#192E03]/50 hover:text-[#192E03]' }}">
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('umkm.index', ['category' => $category]) }}"
                        class="px-4 py-2 text-sm font-medium rounded-full transition
                        {{ request('category') === $category ? 'bg-[#192E03] text-white shadow-sm' : 'bg-white border border-slate-300 text-slate-600 hover:border-[#192E03]/50 hover:text-[#192E03]' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($umkms->isEmpty())
            <p class="text-slate-500 text-center">Belum ada data UMKM.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($umkms as $umkm)
                    <a href="{{ route('umkm.show', $umkm) }}"
                        class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col">
                        <div class="relative overflow-hidden aspect-[4/3]">
                            @if ($umkm->photo)
                                <img src="{{ Storage::url($umkm->photo) }}"
                                    alt="{{ $umkm->photo_alt ?? $umkm->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                            @endif
                            @if ($umkm->category)
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-[#192E03] text-white text-[11px] font-semibold shadow-sm">
                                    {{ $umkm->category }}
                                </span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-[#192E03] group-hover:text-[#192E03] transition">{{ $umkm->name }}</h3>
                            @if ($umkm->owner_name)
                                <p class="text-sm text-slate-500 mt-1">Pemilik: {{ $umkm->owner_name }}</p>
                            @endif
                            @if ($umkm->phone)
                                <p class="text-xs text-slate-500 mt-3 inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                                    </svg>
                                    {{ $umkm->phone }}
                                </p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $umkms->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
