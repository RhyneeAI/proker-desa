<x-layouts.admin title="Kelola Pengumuman">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Pengumuman</h2>
            <p class="text-secondary mb-0">Kelola pengumuman resmi desa</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Pengumuman
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>
                                <p class="fw-medium text-body text-truncate mb-0">{{ $announcement->title }}</p>
                                <p class="text-secondary small mb-0">{{ $announcement->slug }}</p>
                            </td>
                            <td>
                                <span class="badge text-white shadow-sm {{ $announcement->is_published ? 'bg-success' : 'bg-warning' }}">
                                    <span class="status-dot me-1"></span>
                                    {{ $announcement->is_published ? 'Terbit' : 'Draf' }}
                                </span>
                            </td>
                            <td class="text-secondary text-nowrap small">
                                {{ $announcement->published_at?->translatedFormat('d F Y') ?? '-' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <form method="POST" action="{{ route('admin.pengumuman.toggle', $announcement) }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-icon {{ $announcement->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                            title="{{ $announcement->is_published ? 'Turunkan (unpublish)' : 'Terbitkan' }}">
                                            <i class="ti {{ $announcement->is_published ? 'ti-eye-off' : 'ti-eye' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.pengumuman.edit', $announcement) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $announcement) }}"
                                        onsubmit="return confirm('Hapus pengumuman ini?');">
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
