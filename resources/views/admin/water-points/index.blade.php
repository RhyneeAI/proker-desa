<x-layouts.admin title="Kelola Titik Air">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Titik Air</h2>
            <p class="text-secondary mb-0">Kelola data titik air desa</p>
        </div>
        <a href="{{ route('admin.titik-air.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Titik Air
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Koordinat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($waterPoints as $waterPoint)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($waterPoint->photo)
                                    <img src="{{ Storage::url($waterPoint->photo) }}" data-lightbox="{{ Storage::url($waterPoint->photo) }}"
                                        alt="{{ $waterPoint->photo_alt }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-droplet text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $waterPoint->name }}</p>
                            </td>
                            <td>
                                @if ($waterPoint->category)
                                    <span class="badge bg-secondary">{{ $waterPoint->category }}</span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($waterPoint->status)
                                    @php
                                        $badgeColor = match ($waterPoint->status) {
                                            'Rusak' => 'bg-danger',
                                            'Pemeliharaan' => 'bg-warning',
                                            default => 'bg-success',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">{{ $waterPoint->status }}</span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($waterPoint->latitude && $waterPoint->longitude)
                                    <a href="https://www.google.com/maps?q={{ $waterPoint->latitude }},{{ $waterPoint->longitude }}"
                                        target="_blank"
                                        class="text-primary">
                                        Lihat Peta
                                    </a>
                                @else
                                    <span class="text-secondary">Belum diisi</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.titik-air.edit', $waterPoint) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.titik-air.destroy', $waterPoint) }}"
                                        onsubmit="return confirm('Hapus data titik air ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada data titik air.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
