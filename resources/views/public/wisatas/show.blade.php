<x-layouts.public :title="$wisata->name">
    <x-public-page-header :title="$wisata->name"
        eyebrow="Wisata Desa"
        :crumbs="[
            ['label' => 'Wisata', 'url' => route('wisata.index')],
            ['label' => Str::limit($wisata->name, 30)],
        ]" />

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- Foto --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm aspect-[4/3] sticky top-24">
                    @if ($wisata->photo)
                        <img src="{{ Storage::url($wisata->photo) }}"
                            alt="{{ $wisata->photo_alt ?? $wisata->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#192E03]/5 to-slate-100 flex items-center justify-center">
                            <svg class="w-14 h-14 text-[#3A5C0A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 15l6-6 4 4 8-8M15 5h5v5"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Detail --}}
            <div class="lg:col-span-3">
                @if ($wisata->category)
                    <span class="inline-flex px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold">
                        {{ $wisata->category }}
                    </span>
                @endif

                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#192E03] mt-3">{{ $wisata->name }}</h1>

                @if ($wisata->description)
                    <div class="mt-6 bg-white border border-slate-200 rounded-2xl p-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#192E03] mb-3">Deskripsi</h2>
                        <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $wisata->description }}</p>
                    </div>
                @endif

                <div class="mt-6 space-y-3">
                    @if ($wisata->opening_hours)
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3">
                            <div class="w-9 h-9 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Jam Buka</p>
                                <p class="text-sm font-medium text-slate-800">{{ $wisata->opening_hours }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($wisata->ticket_price)
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3">
                            <div class="w-9 h-9 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Harga Tiket</p>
                                <p class="text-sm font-medium text-slate-800">{{ $wisata->ticket_price }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($wisata->address)
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 py-3">
                            <div class="w-9 h-9 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Alamat</p>
                                <p class="text-sm font-medium text-slate-800">{{ $wisata->address }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($wisata->latitude && $wisata->longitude)
                    <div class="mt-6">
                        <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}"
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
