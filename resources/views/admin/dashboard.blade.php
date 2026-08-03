<x-layouts.admin title="Dashboard">

    {{-- Kartu Statistik --}}
    <div class="row g-3 mb-3">
        @foreach ([
            ['label' => 'Fasilitas', 'value' => $stats['facilities'], 'icon' => 'ti-building-community', 'route' => 'admin.fasilitas.index'],
            ['label' => 'UMKM', 'value' => $stats['umkms'], 'icon' => 'ti-shopping-bag', 'route' => 'admin.umkm.index'],
            ['label' => 'Titik Air', 'value' => $stats['waterPoints'], 'icon' => 'ti-droplet', 'route' => 'admin.titik-air.index'],
            ['label' => 'Berita', 'value' => $stats['news'], 'icon' => 'ti-news', 'route' => 'admin.berita.index'],
        ] as $card)
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <a href="{{ route($card['route']) }}" class="card text-decoration-none h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar avatar-lg bg-primary-lt text-primary">
                            <i class="ti {{ $card['icon'] }}"></i>
                        </span>
                        <div>
                            <div class="fs-2 fw-bold text-primary">{{ $card['value'] }}</div>
                            <div class="text-secondary small fw-medium">{{ $card['label'] }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Kunjungan --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Kunjungan</h3>
                </div>
                <div class="card-body d-flex flex-column justify-content-center gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary">Hari Ini</span>
                        <span class="fs-3 fw-bold">{{ number_format($todayVisits, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary">Pengunjung Unik Hari Ini</span>
                        <span class="fs-3 fw-bold">{{ number_format($todayUnique, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary">Total Pengunjung</span>
                        <span class="fs-3 fw-bold">{{ number_format($totalVisits, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8 mx-auto" data-aos="fade-up" data-aos-delay="150">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kunjungan 30 Hari Terakhir</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartVisits" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengumuman Terbaru --}}
    <div class="row g-3 mb-3">
        <div class="col-12" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengumuman Terbaru (Terbit)</h3>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-link btn-sm ms-auto">Lihat Semua</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse ($latestAnnouncements as $announcement)
                        <div class="list-group-item">
                            <p class="text-body fw-medium text-truncate mb-1">{{ $announcement->title }}</p>
                            <span class="text-secondary small">{{ $announcement->published_at?->translatedFormat('d F Y') }}</span>
                        </div>
                    @empty
                        <div class="list-group-item text-center text-secondary py-4">Belum ada pengumuman yang diterbitkan.</div>
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
            <a href="{{ route('admin.titik-air.create') }}" class="btn btn-outline-primary w-100 py-3">
                <i class="ti ti-plus me-1"></i> Tambah Titik Air
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
                const canvas = document.getElementById('chartVisits');
                if (!canvas) return;
                new Chart(canvas, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Kunjungan',
                            data: @json($chartData),
                            borderColor: '#192E03',
                            backgroundColor: 'rgba(25, 46, 3, 0.12)',
                            fill: true,
                            tension: 0.35,
                            pointRadius: 3,
                            borderWidth: 2,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                            x: { ticks: { maxTicksLimit: 10 } },
                        },
                    },
                });
            })();
        </script>
    @endpush
</x-layouts.admin>
