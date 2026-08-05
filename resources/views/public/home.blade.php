<x-layouts.public title="Beranda">

    {{-- ================= HERO SLIDER ================= --}}
    @php
        $heroSlidesData = $heroSlides->map(function ($slide) {
            return [
                'src' => $slide->image && Storage::disk('public')->exists($slide->image)
                    ? Storage::url($slide->image)
                    : 'https://picsum.photos/seed/hero-' . $slide->id . '/1920/1080',
                'alt' => $slide->image_alt ?? ($slide->title ?: 'Slide'),
                'title' => $slide->title,
                'subtitle' => $slide->subtitle,
            ];
        })->values()->toArray();

        if (empty($heroSlidesData)) {
            $heroSlidesData = [
                ['src' => 'https://picsum.photos/seed/village1/1920/1080', 'alt' => 'Slide 1', 'title' => null, 'subtitle' => null],
                ['src' => 'https://picsum.photos/seed/village2/1920/1080', 'alt' => 'Slide 2', 'title' => null, 'subtitle' => null],
                ['src' => 'https://picsum.photos/seed/village3/1920/1080', 'alt' => 'Slide 3', 'title' => null, 'subtitle' => null],
                ['src' => 'https://picsum.photos/seed/village4/1920/1080', 'alt' => 'Slide 4', 'title' => null, 'subtitle' => null],
                ['src' => 'https://picsum.photos/seed/village5/1920/1080', 'alt' => 'Slide 5', 'title' => null, 'subtitle' => null],
            ];
        }
    @endphp
    <section class="relative w-full h-screen overflow-hidden"
        x-data="{
            aktif: 0,
            total: {{ count($heroSlidesData) }},
            interval: null,
            slides: @js($heroSlidesData),
            prefersReducedMotion() {
                return window.matchMedia('(prefers-reduced-motion: reduce)').matches
            },
            prev() {
                this.aktif = this.aktif === 0 ? this.total - 1 : this.aktif - 1
                this.reset()
            },
            next() {
                this.aktif = this.aktif === this.total - 1 ? 0 : this.aktif + 1
                this.reset()
            },
            reset() {
                clearInterval(this.interval)
                if (this.prefersReducedMotion()) return
                this.interval = setInterval(() => this.next(), 5000)
            },
            init() {
                if (this.prefersReducedMotion()) return
                this.interval = setInterval(() => this.next(), 5000)
            }
        }"
        @mouseenter="reset()"
        @mouseleave="reset()">

        {{-- Slide --}}
        <template x-for="(slide, i) in slides" :key="i">
            <div x-show="aktif === i" class="absolute inset-0"
                x-transition:enter="transition-opacity duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-700"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                <img :src="slide.src" :alt="slide.alt" loading="eager" fetchpriority="high" class="w-full h-full object-cover object-center">
            </div>
        </template>

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/45 z-10"></div>

        {{-- Konten Tengah --}}
        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-white font-black uppercase tracking-tight text-4xl sm:text-6xl lg:text-7xl drop-shadow-lg leading-[1.1]">
                Selamat datang di
                <span class="block">{{ strtoupper($profile?->village_name ?? 'DESA CIBULAKAN') }}</span>
            </h1>
            <p class="mt-5 text-white text-lg sm:text-xl font-medium max-w-2xl drop-shadow"
                x-text="slides[aktif]?.subtitle || 'Sumber informasi resmi tentang pemerintahan dan pelayanan desa'">
                Sumber informasi resmi tentang pemerintahan dan pelayanan desa
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('profile-desa.show') }}"
                    class="px-6 py-3 bg-[#192E03] hover:bg-[#192E03]/90 text-white text-sm font-semibold rounded-full shadow-lg transition">
                    Profil Desa
                </a>
                <a href="{{ route('berita.index') }}"
                    class="px-6 py-3 border border-white text-white text-sm font-semibold rounded-full hover:bg-white/10 transition">
                    Berita Desa
                </a>
            </div>
        </div>

        {{-- Tombol Panah --}}
        <button @click="prev()" aria-label="Slide sebelumnya"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 backdrop-blur-sm transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button @click="next()" aria-label="Slide berikutnya"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 backdrop-blur-sm transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Dot Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex gap-2">
            <template x-for="(slide, i) in slides" :key="'dot-' + i">
                <button @click="aktif = i" :aria-label="'Ke slide ' + (i + 1)"
                    class="rounded-full transition-all duration-300"
                    :class="i === aktif ? 'bg-white w-3 h-3' : 'bg-white/50 w-2 h-2 hover:bg-white/70'"></button>
            </template>
        </div>
    </section>

    {{-- ================= STATS BAR ================= --}}
    <section class="bg-[#192E03] text-white" data-aos="fade-down">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p x-data="countUp({{ $profile?->population ?: 0 }})" x-text="formatted" class="text-3xl sm:text-4xl font-extrabold">0</p>
                    <p class="text-white/80 text-sm mt-1">Jumlah Penduduk</p>
                </div>
                <div>
                    <p x-data="countUp({{ $profile?->area_size ?: 0 }}, { decimals: 2 })" x-text="formatted" class="text-3xl sm:text-4xl font-extrabold">0</p>
                    <p class="text-white/80 text-sm mt-1">Luas Wilayah (km²)</p>
                </div>
                <div>
                    <p x-data="countUp({{ $todayVisitors }})" x-text="formatted" class="text-3xl sm:text-4xl font-extrabold">0</p>
                    <p class="text-white/80 text-sm mt-1">Pengunjung Hari Ini</p>
                </div>
                <div>
                    <p x-data="countUp({{ $totalVisitors }})" x-text="formatted" class="text-3xl sm:text-4xl font-extrabold">0</p>
                    <p class="text-white/80 text-sm mt-1">Total Pengunjung</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= PENGUMUMAN TERBARU ================= --}}
    <section class="bg-white" data-aos="fade-up">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-16 sm:pb-20">

            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5"/>
                    </svg>
                    Informasi Resmi
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#192E03]">Pengumuman</h2>
                <p class="mt-3 text-[#192E03] opacity-80 max-w-xl mx-auto">Pengumuman resmi dari pemerintah desa yang perlu diketahui masyarakat.</p>
            </div>

            @if ($latestAnnouncements->isEmpty())
                <p class="text-slate-500 text-sm text-center">Belum ada pengumuman.</p>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach ($latestAnnouncements as $announcement)
                        <a href="{{ route('pengumuman.show', $announcement->slug) }}"
                            class="group relative bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 hover:border-[#192E03]/40 transition-all duration-300 overflow-hidden">
                            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#192E03] to-[#2D4D08] opacity-0 group-hover:opacity-100 transition"></div>

                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 group-hover:bg-[#192E03] flex items-center justify-center flex-shrink-0 transition-colors">
                                        <svg class="w-5 h-5 text-[#192E03] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs text-slate-500 inline-flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $announcement->published_at?->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                            </div>

                            <h3 class="mt-4 font-bold text-lg text-[#192E03] leading-snug line-clamp-2 group-hover:text-[#192E03] transition">{{ $announcement->title }}</h3>
                            <p class="mt-2 text-sm text-slate-500 leading-relaxed line-clamp-2">
                                {{ Str::limit(strip_tags($announcement->content), 110) }}
                            </p>

                            <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-[#192E03] group-hover:text-[#192E03] transition">
                                Selengkapnya
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mt-10 flex justify-end">
                <a href="{{ route('pengumuman.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#192E03] hover:bg-[#1F3B04] rounded-full shadow-md shadow-[#192E03]/20 transition">
                    Lihat Semua Pengumuman
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ================= BERITA TERBARU ================= --}}
    <section class="bg-slate-50" data-aos="fade-down">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-16 sm:pb-20">

            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                    </svg>
                    Kabar Desa
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#192E03]">Berita Terbaru</h2>
                <p class="mt-3 text-[#192E03] opacity-80 max-w-xl mx-auto">Informasi terkini seputar kegiatan, pembangunan, dan layanan desa.</p>
            </div>

            @if ($latestNews->isEmpty())
                <p class="text-slate-500 text-sm text-center">Belum ada berita yang diterbitkan.</p>
            @else
                <div class="relative" x-data="newsSlider()"
                    @mouseenter="pause()" @mouseleave="play()"
                    x-init="$el.querySelector('.news-track')?.scrollLeft || true">
                    <div x-ref="track"
                        class="news-track flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4"
                        style="scrollbar-width:none;-ms-overflow-style:none">
                        @foreach ($latestNews as $news)
                            <a href="{{ route('berita.show', $news->slug) }}"
                                class="news-slide snap-start shrink-0 w-full sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                                <div class="relative overflow-hidden aspect-video">
                                    @php
                                        $newsImg = $news->thumbnail && Storage::disk('public')->exists($news->thumbnail)
                                            ? Storage::url($news->thumbnail)
                                            : 'https://picsum.photos/seed/news-' . $news->id . '/800/450';
                                    @endphp
                                    <img src="{{ $newsImg }}"
                                        alt="{{ $news->thumbnail_alt ?? $news->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-[#192E03] text-white text-[11px] font-semibold shadow-sm">Berita</span>
                                </div>
                                <div class="p-5 flex flex-col flex-1">
                                    <p class="text-xs text-[#192E03]/70 inline-flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $news->published_at?->translatedFormat('d F Y') }}
                                    </p>
                                    <h3 class="font-bold text-[#192E03] mt-2 line-clamp-2 leading-snug group-hover:text-[#192E03] transition">{{ $news->title }}</h3>
                                    <span class="mt-auto pt-4 text-sm font-semibold text-[#192E03] group-hover:text-[#192E03] inline-flex items-center gap-1.5 transition">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if ($latestNews->count() > 3)
                        <button @click="prev()" aria-label="Berita sebelumnya"
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-md border border-slate-200 text-slate-600 rounded-full p-2 hover:bg-[#192E03] hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="next()" aria-label="Berita berikutnya"
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-md border border-slate-200 text-slate-600 rounded-full p-2 hover:bg-[#192E03] hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @endif
                </div>
            @endif

            <div class="mt-10 flex justify-end">
                <a href="{{ route('berita.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#192E03] hover:bg-[#1F3B04] rounded-full shadow-md shadow-[#192E03]/20 transition">
                    Lihat Semua Berita
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ================= GALERI FOTO (WALLPAPER CAROUSEL) ================= --}}
    <section class="bg-slate-900 text-white" data-aos="fade-up"
        x-data="{
            aktif: 0,
            total: {{ $galleries->count() }},
            interval: null,
            reduced() { return window.matchMedia('(prefers-reduced-motion: reduce)').matches },
            prev() { this.aktif = this.aktif === 0 ? this.total - 1 : this.aktif - 1; this.reset() },
            next() { this.aktif = this.aktif === this.total - 1 ? 0 : this.aktif + 1; this.reset() },
            reset() { clearInterval(this.interval); if (this.reduced()) return; this.interval = setInterval(() => this.next(), 5000) },
            init() { if (this.reduced()) return; this.interval = setInterval(() => this.next(), 5000) }
        }"
        @mouseenter="reset()"
        @mouseleave="reset()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">

            <div class="text-center mb-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[#3A5C0A] text-xs font-semibold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri Foto
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-white">Galeri Foto Desa</h2>
                <p class="mt-3 text-white/70 max-w-xl mx-auto">Dokumentasi kegiatan dan suasana desa.</p>
            </div>

            @if ($galleries->isNotEmpty())
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    @foreach ($galleries as $i => $gallery)
                        @php
                            $galleryImg = Storage::disk('public')->exists($gallery->image)
                                ? Storage::url($gallery->image)
                                : 'https://picsum.photos/seed/gallery-' . $gallery->id . '/1600/900';
                        @endphp
                        <div x-show="aktif === {{ $i }}" class="relative h-[420px] lg:h-[520px]"
                            x-transition:enter="transition-opacity duration-700"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100">
                            <img src="{{ $galleryImg }}"
                                alt="{{ $gallery->image_alt ?? $gallery->title }}"
                                loading="lazy"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 inset-x-0 p-6 sm:p-8">
                                @if ($gallery->category)
                                    <span class="inline-block px-2.5 py-1 rounded-full bg-[#192E03] text-white text-xs font-semibold">
                                        {{ $gallery->category }}
                                    </span>
                                @endif
                                <h3 class="mt-3 text-xl sm:text-2xl font-bold text-white">{{ $gallery->title }}</h3>
                                @if ($gallery->description)
                                    <p class="mt-1 text-sm text-white/80 line-clamp-2 max-w-2xl">{{ $gallery->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <button @click="prev()" aria-label="Slide sebelumnya"
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 backdrop-blur-sm transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button @click="next()" aria-label="Slide berikutnya"
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white rounded-full p-3 backdrop-blur-sm transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                        <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                        @foreach ($galleries as $i => $gallery)
                            <button @click="aktif = {{ $i }}" :aria-label="'Ke slide ' + ({{ $i }} + 1)"
                                class="rounded-full transition-all duration-300"
                                :class="aktif === {{ $i }} ? 'bg-white w-3 h-3' : 'bg-white/50 w-2 h-2 hover:bg-white/70'"></button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('galeri.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#192E03] hover:bg-[#1F3B04] rounded-full transition">
                        Lihat Semua Galeri Foto
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @else
                <p class="text-white/70 text-sm text-center">Belum ada foto galeri.</p>
            @endif
        </div>
    </section>

    {{-- ================= PETA DESA ================= --}}
    <section class="bg-white" data-aos="fade-down">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-16 sm:pb-20">

            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Lokasi & Wilayah
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#192E03]">Peta Desa</h2>
                <p class="mt-3 text-[#192E03] opacity-80 max-w-xl mx-auto">Lihat lokasi dan wilayah {{ $profile?->village_name ?? 'Desa' }} pada peta interaktif.</p>
            </div>

            <x-map-legend class="mb-5" />

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                @if ($umkms->isNotEmpty() || $facilities->isNotEmpty() || $waterPoints->isNotEmpty())
                    <x-interactive-map :umkms="$umkms" :facilities="$facilities" :water-points="$waterPoints" center-label="{{ $profile?->village_name ?? 'Desa' }}" height="h-96 lg:h-[450px]" />
                @else
                    <div class="h-96 lg:h-[450px] bg-slate-50 flex flex-col items-center justify-center text-center px-6">
                        <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <p class="text-lg font-bold text-slate-700">Peta belum tersedia</p>
                        <p class="text-sm text-slate-500 mt-1.5 max-w-md">Admin dapat menambahkan titik UMKM dan fasilitas (beserta koordinat) melalui dashboard</p>
                        @auth
                            <div class="mt-5 flex flex-wrap items-center justify-center gap-3">
                                <a href="{{ route('admin.umkm.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                    Tambah UMKM
                                </a>
                                <a href="{{ route('admin.fasilitas.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-xl hover:bg-[#1F3B04] transition">
                                    Tambah Fasilitas
                                </a>
                            </div>
                        @endauth
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-5 border-t border-slate-200">
                    <p class="text-sm text-slate-600 text-center sm:text-left">
                        <span class="font-bold text-[#192E03]">{{ $profile?->village_name ?? 'Desa Cibulakan' }}</span>
                        — {{ $profile?->address ?? 'Alamat belum diisi' }}
                    </p>
                    <a href="{{ route('peta-desa.show') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-[#192E03] hover:bg-[#1F3B04] rounded-full shadow-md shadow-[#192E03]/20 transition flex-shrink-0">
                        Lihat Peta Lengkap
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= LAYANAN DESA ================= --}}
    <section class="bg-slate-50" data-aos="fade-up">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-16 sm:pb-20">
            <div class="text-center mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#192E03]/10 text-[#192E03] text-xs font-semibold uppercase tracking-widest">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Layanan & Informasi
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#192E03]">Layanan Desa</h2>
                <p class="mt-3 text-[#192E03] opacity-80 max-w-2xl mx-auto">Akses cepat layanan dan informasi publik untuk masyarakat.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['label' => 'Aparatur Desa', 'desc' => 'Struktur perangkat desa', 'route' => 'aparatur.index', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0'],
                    ['label' => 'UMKM Desa', 'desc' => 'Produk unggulan warga', 'route' => 'umkm.index', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                    ['label' => 'Fasilitas Umum', 'desc' => 'Sarana & prasarana desa', 'route' => 'fasilitas.index', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                    ['label' => 'Galeri Foto', 'desc' => 'Dokumentasi kegiatan', 'route' => 'galeri.index', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ] as $item)
                    <a href="{{ route($item['route']) }}"
                        data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 100 }}"
                        class="group flex flex-col items-center text-center gap-3 bg-white border border-slate-200 rounded-2xl p-7 hover:border-[#192E03]/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="w-14 h-14 bg-[#192E03]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#192E03] transition-colors">
                            <svg class="w-7 h-7 text-[#192E03] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-[#192E03] group-hover:text-[#192E03] transition">{{ $item['label'] }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $item['desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= CTA PENUTUP ================= --}}
    <section class="relative overflow-hidden bg-[#192E03]" data-aos="zoom-in">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#2D4D08]/40 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 rounded-full bg-[#3A5C0A]/30 blur-3xl" aria-hidden="true"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                Butuh Informasi Lebih Lanjut?
            </h2>
            <p class="mt-4 text-white/80 max-w-2xl mx-auto">
                Kunjungi kantor desa atau jelajahi profil, layanan, dan potensi desa untuk mengenal desa kami lebih dekat.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="https://wa.me/6287891472177" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white text-[#192E03] text-sm font-semibold rounded-full shadow-lg hover:bg-[#192E03]/5 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 004.74 1.21c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm0 18.15c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.26 8.26 0 01-1.26-4.38c0-4.54 3.7-8.24 8.25-8.24 2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 012.41 5.83c0 4.54-3.7 8.23-8.23 8.23zm4.52-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.39-.12-.56.13-.16.25-.64.8-.78.97-.14.16-.29.18-.54.06-.25-.12-1.05-.39-1.99-1.23-.74-.66-1.23-1.47-1.38-1.72-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.14.17-.25.25-.41.08-.17.04-.31-.02-.43-.06-.12-.56-1.34-.76-1.84-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31-.22.25-.86.85-.86 2.07 0 1.22.89 2.4 1.01 2.56.12.17 1.75 2.67 4.23 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.07.15-1.18-.06-.1-.23-.16-.48-.29z"/>
                    </svg>
                    Hubungi Kami
                </a>
                <a href="{{ route('profile-desa.show') }}"
                    class="px-6 py-3 border border-white/70 text-white text-sm font-semibold rounded-full hover:bg-white/10 transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Profil Desa
                </a>
            </div>
        </div>
    </section>

</x-layouts.public>
