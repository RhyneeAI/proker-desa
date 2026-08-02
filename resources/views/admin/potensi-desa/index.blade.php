<x-layouts.admin title="Kelola Potensi Desa">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Potensi Desa</h2>
            <p class="text-secondary mb-0">Kelola potensi dan kekayaan desa</p>
        </div>
        <a href="{{ route('admin.potensi-desa.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Potensi
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>Potensi</th>
                        <th>Kategori</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($potensiDesa as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if ($item->image)
                                        <img src="{{ Storage::url($item->image) }}"
                                            alt="{{ $item->image_alt ?? $item->name }}"
                                            class="avatar avatar-sm rounded">
                                    @else
                                        <span class="avatar avatar-sm bg-secondary-lt rounded">
                                            <i class="ti ti-mountain text-secondary"></i>
                                        </span>
                                    @endif
                                    <div>
                                        <p class="fw-medium text-body mb-0">{{ $item->name }}</p>
                                        @if ($item->description)
                                            <p class="text-secondary small text-truncate mb-0" style="max-width:16rem">{{ $item->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary text-capitalize">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    <a href="{{ route('admin.potensi-desa.edit', $item) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.potensi-desa.destroy', $item) }}"
                                        onsubmit="return confirm('Hapus potensi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada potensi desa.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
