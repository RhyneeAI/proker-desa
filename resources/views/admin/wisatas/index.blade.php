<x-layouts.admin title="Kelola Wisata">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Wisata</h2>
            <p class="text-secondary mb-0">Kelola data destinasi wisata desa</p>
        </div>
        <a href="{{ route('admin.wisata.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Wisata
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
                        <th>Alamat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wisatas as $wisata)
                        <tr>
                            <td class="text-secondary">{{ $loop->iteration }}</td>
                            <td>
                                @if ($wisata->photo)
                                    <img src="{{ Storage::url($wisata->photo) }}" data-lightbox="{{ Storage::url($wisata->photo) }}"
                                        alt="{{ $wisata->photo_alt }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-photo text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $wisata->name }}</p>
                            </td>
                            <td>
                                @if ($wisata->category)
                                    <span class="badge bg-secondary">{{ $wisata->category }}</span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($wisata->address)
                                    <span class="text-secondary">{{ Str::limit($wisata->address, 50) }}</span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.wisata.edit', $wisata) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.wisata.destroy', $wisata) }}"
                                        onsubmit="return confirm('Hapus data wisata ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada data wisata.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
