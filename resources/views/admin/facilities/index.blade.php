<x-layouts.admin title="Kelola Fasilitas Umum">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Fasilitas Umum</h2>
            <p class="text-secondary mb-0">Kelola data fasilitas umum desa</p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Fasilitas
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Fasilitas</th>
                        <th>Alamat</th>
                        <th>Koordinat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facilities as $facility)
                        <tr>
                            <td>
                                @if ($facility->photo)
                                    <img src="{{ Storage::url($facility->photo) }}" data-lightbox="{{ Storage::url($facility->photo) }}"
                                        alt="{{ $facility->photo_alt }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-photo text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $facility->name }}</p>
                            </td>
                            <td class="text-secondary text-truncate">{{ $facility->address ?? '-' }}</td>
                            <td>
                                @if ($facility->latitude && $facility->longitude)
                                    <a href="https://www.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}"
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
                                    <a href="{{ route('admin.fasilitas.edit', $facility) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.fasilitas.destroy', $facility) }}"
                                        onsubmit="return confirm('Hapus fasilitas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
