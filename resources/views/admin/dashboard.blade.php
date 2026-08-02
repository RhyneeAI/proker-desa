<x-layouts.admin title="Dashboard">

    {{-- Stat Cards --}}
    <div class="row g-3 mb-3">
        @foreach ([
            'Berita'        => $stats['news'],
            'Pengumuman'    => $stats['announcements'],
            'Aparatur'      => $stats['officials'],
            'UMKM'          => $stats['umkms'],
            'Fasilitas'     => $stats['facilities'],
            'Foto Galeri'   => $stats['galleries'],
            'Titik Air'     => $stats['waterPoints'],
            'Wisata'        => $stats['wisatas'],
        ] as $label => $value)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="fs-2 fw-bold text-primary">{{ $value }}</div>
                        <div class="text-secondary text-uppercase small fw-medium">{{ $label }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Grafik --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">UMKM per Kategori</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartUmkm" height="220"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Titik Air per Status</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartWater" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita & Pengumuman Terbaru --}}
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Berita Terbaru</h3>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-link btn-sm ms-auto">Lihat Semua</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($latestNews as $news)
                        @php
                            $newsImg = $news->thumbnail && Storage::disk('public')->exists($news->thumbnail)
                                ? Storage::url($news->thumbnail)
                                : 'https://picsum.photos/seed/news-' . $news->id . '/120/120';
                        @endphp
                        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
                            <div class="d-flex align-items-start gap-3 min-w-0">
                                <img src="{{ $newsImg }}" alt="{{ $news->thumbnail_alt ?? $news->title }}"
                                    class="rounded flex-shrink-0" style="width:56px;height:40px;object-fit:cover">
                                <div class="min-w-0">
                                    <p class="text-body fw-medium text-truncate mb-1">{{ $news->title }}</p>
                                    <p class="text-secondary small mb-0">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <span class="badge {{ $news->is_published ? 'bg-success' : 'bg-secondary' }} text-nowrap">
                                {{ $news->is_published ? 'Terbit' : 'Draf' }}
                            </span>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-secondary py-4">Belum ada berita.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengumuman Terbaru</h3>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-link btn-sm ms-auto">Lihat Semua</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($latestAnnouncements as $announcement)
                        <div class="list-group-item">
                            <p class="text-body fw-medium text-truncate mb-1">{{ $announcement->title }}</p>
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-secondary small">{{ $announcement->published_at?->translatedFormat('d F Y') }}</span>
                                @if ($announcement->deadline)
                                    <span class="badge {{ $announcement->deadline->isPast() ? 'bg-danger' : 'bg-warning' }}">
                                        Tenggat {{ $announcement->deadline->translatedFormat('d F Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-secondary py-4">Belum ada pengumuman.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Shortcut --}}
    <div class="row g-3 mt-1">
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.berita.create') }}" class="btn btn-outline-primary w-100 py-3">
                <i class="ti ti-plus me-1"></i> Tambah Berita
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-outline-primary w-100 py-3">
                <i class="ti ti-plus me-1"></i> Tambah Pengumuman
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-outline-primary w-100 py-3">
                <i class="ti ti-plus me-1"></i> Upload Foto
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.umkm.create') }}" class="btn btn-outline-primary w-100 py-3">
                <i class="ti ti-plus me-1"></i> Tambah UMKM
            </a>
        </div>
    </div>

    @push('scripts')
        <script>
            window.Chart && (function () {
                const palette = ['#192E03', '#2D4D08', '#3A5C0A', '#4d7c0f', '#65a30d', '#84cc16', '#a3e635'];

                const umkmCanvas = document.getElementById('chartUmkm');
                if (umkmCanvas) {
                    new Chart(umkmCanvas, {
                        type: 'bar',
                        data: {
                            labels: @json($umkmByCategory->keys()),
                            datasets: [{
                                label: 'Jumlah',
                                data: @json($umkmByCategory->values()),
                                backgroundColor: '#192E03',
                                borderRadius: 6,
                                maxBarThickness: 48,
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { display: false } },
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                        },
                    });
                }

                const waterCanvas = document.getElementById('chartWater');
                if (waterCanvas) {
                    new Chart(waterCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: @json($waterPointByStatus->keys()),
                            datasets: [{
                                data: @json($waterPointByStatus->values()),
                                backgroundColor: palette,
                                borderWidth: 2,
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { position: 'bottom' } },
                        },
                    });
                }
            })();
        </script>
    @endpush
</x-layouts.admin>
