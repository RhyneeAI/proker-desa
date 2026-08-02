<x-layouts.admin title="Kelola Potensi Desa">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Potensi Desa</h2>
            <p class="text-secondary mb-0">Kelola potensi dan kekayaan desa</p>
        </div>
        <a href="{{ route('admin.potensi.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Potensi
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Potensi</th>
                        <th>Kategori</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($potentials as $potential)
                        <tr>
                            <td>
                                @if ($potential->photo)
                                    <img src="{{ Storage::url($potential->photo) }}"
                                        alt="{{ $potential->photo_alt ?? $potential->name }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-mountain text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $potential->name }}</p>
                                @if ($potential->description)
                                    <p class="text-secondary small text-truncate mb-0" style="max-width:16rem">{{ Str::limit($potential->description, 60) }}</p>
                                @endif
                            </td>
                            <td>
                                @if ($potential->category)
                                    <span class="badge bg-primary text-capitalize">
                                        {{ $potential->category }}
                                    </span>
                                @else
                                    <span class="text-secondary">—</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    <a href="{{ route('admin.potensi.edit', $potential) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.potensi.destroy', $potential) }}"
                                        onsubmit="return confirm('Hapus potensi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada data potensi desa.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $potentials->links() }}
    </div>
</x-layouts.admin>
