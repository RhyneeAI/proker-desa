<x-layouts.public :title="$umkm->name" :meta-description="Str::limit(strip_tags($umkm->description ?? ''), 160)">
    <x-public-page-header :title="$umkm->name"
        eyebrow="UMKM Desa"
        :crumbs="[
            ['label' => 'UMKM', 'url' => route('umkm.index')],
            ['label' => Str::limit($umkm->name, 30)],
        ]" />

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Foto --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm aspect-[4/3] sticky top-24">
                    @if ($umkm->photo)
                        <img src="{{ Storage::url($umkm->photo) }}"
                            alt="{{ $umkm->photo_alt ?? $umkm->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                            <svg class="w-14 h-14 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Detail --}}
            <div class="lg:col-span-3">
                @if ($umkm->category)
                    <span class="inline-flex px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold">
                        {{ $umkm->category }}
                    </span>
                @endif

                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#192E03] mt-3">{{ $umkm->name }}</h1>
                @if ($umkm->owner_name)
                    <p class="text-slate-500 mt-1">Pemilik: <span class="text-slate-700 font-medium">{{ $umkm->owner_name }}</span></p>
                @endif

                @if ($umkm->description)
                    <div class="mt-6 bg-white border border-slate-200 rounded-2xl p-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#192E03] mb-3">Deskripsi</h2>
                        <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $umkm->description }}</p>
                    </div>
                @endif

                <div class="mt-6 space-y-3">
                    @if ($umkm->phone)
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3">
                            <div class="w-9 h-9 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Telepon</p>
                                <p class="text-sm font-medium text-slate-800">{{ $umkm->phone }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($umkm->address)
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3">
                            <div class="w-9 h-9 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Alamat</p>
                                <p class="text-sm font-medium text-slate-800">{{ $umkm->address }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($umkm->latitude && $umkm->longitude)
                    <div class="mt-6">
                        <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                            target="_blank"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-[#192E03] hover:bg-[#1F3B04] text-white text-sm font-semibold rounded-xl shadow-sm transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Lihat Lokasi di Google Maps
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
