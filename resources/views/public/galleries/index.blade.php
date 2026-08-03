<x-layouts.public title="Galeri">
    <x-public-page-header title="Galeri Desa"
        eyebrow="Dokumentasi"
        description="Dokumentasi kegiatan dan potret kehidupan masyarakat Desa Cibulakan."
        :crumbs="[['label' => 'Galeri']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Filter Kategori --}}
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('galeri.index') }}"
                class="px-4 py-2 text-sm font-medium rounded-full transition
                {{ ! request('category') ? 'bg-[#192E03] text-white shadow-sm' : 'bg-white border border-slate-300 text-slate-600 hover:border-[#192E03]/50 hover:text-[#192E03]' }}">
                Semua
            </a>
            @foreach (['kegiatan' => 'Kegiatan', 'fasilitas' => 'Fasilitas', 'umkm' => 'UMKM', 'lainnya' => 'Lainnya'] as $value => $label)
                <a href="{{ route('galeri.index', ['category' => $value]) }}"
                    class="px-4 py-2 text-sm font-medium rounded-full transition
                    {{ request('category') === $value ? 'bg-[#192E03] text-white shadow-sm' : 'bg-white border border-slate-300 text-slate-600 hover:border-[#192E03]/50 hover:text-[#192E03]' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        @if ($galleries->isEmpty())
            <p class="text-slate-500 text-center">Belum ada foto di galeri.</p>
        @else
            <div class="columns-2 sm:columns-3 lg:columns-4 gap-4 [&>*]:mb-4">
                @foreach ($galleries as $gallery)
                    @php
                        $galleryImg = $gallery->image && Storage::disk('public')->exists($gallery->image)
                            ? Storage::url($gallery->image)
                            : 'https://picsum.photos/seed/gallery-' . $gallery->id . '/600/400';
                    @endphp
                    <div class="break-inside-avoid relative group rounded-2xl overflow-hidden border border-slate-200 shadow-sm cursor-zoom-in bg-slate-200 animate-pulse min-h-44"
                        x-data="{ loaded: false }">
                        <img src="{{ $galleryImg }}"
                            alt="{{ $gallery->image_alt ?? $gallery->title }}"
                            x-on:load="loaded = true; $el.closest('[x-data]')?.classList.remove('animate-pulse')"
                            x-on:error="loaded = true; $el.closest('[x-data]')?.classList.remove('animate-pulse')"
                            :class="loaded ? 'opacity-100' : 'opacity-0'"
                            class="w-full object-cover group-hover:scale-105 transition duration-300"
                            style="transition:opacity .5s"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/10 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4">
                            @if ($gallery->title)
                                <p class="text-white text-sm font-bold">{{ $gallery->title }}</p>
                            @endif
                            @if ($gallery->category)
                                <span class="text-[#3A5C0A] text-xs font-medium mt-1 uppercase tracking-wide">{{ $gallery->category }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $galleries->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
