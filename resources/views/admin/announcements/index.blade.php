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
                        <th>Tenggat Waktu</th>
                        <th>Tanggal Terbit</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                        <tr>
                            <td>
                                <p class="fw-medium text-body text-truncate mb-0">{{ $announcement->title }}</p>
                                <p class="text-secondary small mb-0">{{ $announcement->slug }}</p>
                            </td>
                            <td>
                                <span class="badge {{ $announcement->is_published ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $announcement->is_published ? 'Terbit' : 'Draf' }}
                                </span>
                            </td>
                            <td>
                                @if ($announcement->deadline)
                                    <span class="small {{ $announcement->deadline->isPast() ? 'text-danger' : 'text-warning' }}">
                                        {{ $announcement->deadline->translatedFormat('d F Y') }}
                                        {{ $announcement->deadline->isPast() ? '(Kedaluwarsa)' : '' }}
                                    </span>
                                @else
                                    <span class="small text-secondary">Tanpa batas waktu</span>
                                @endif
                            </td>
                            <td class="text-secondary text-nowrap small">
                                {{ $announcement->published_at?->translatedFormat('d F Y') ?? '-' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.pengumuman.edit', $announcement) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $announcement) }}"
                                        onsubmit="return confirm('Hapus pengumuman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada pengumuman.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
