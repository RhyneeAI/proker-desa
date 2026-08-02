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
        ] as $label => $value)
            <div class="col-6 col-md-4 col-xl-2">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="fs-2 fw-bold text-primary">{{ $value }}</div>
                        <div class="text-secondary text-uppercase small fw-medium">{{ $label }}</div>
                    </div>
                </div>
            </div>
        @endforeach
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
                        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
                            <div class="min-w-0">
                                <p class="text-body fw-medium text-truncate mb-1">{{ $news->title }}</p>
                                <p class="text-secondary small mb-0">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
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
</x-layouts.admin>
