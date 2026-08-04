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
                        <th>Arah Lintasan</th>
                        <th>Debit</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($waterPoints as $waterPoint)
                        @php $docPhotos = $waterPoint->documentation_photos ?? []; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if (!empty($docPhotos[0]))
                                    <img src="{{ Storage::url($docPhotos[0]) }}" data-lightbox="{{ Storage::url($docPhotos[0]) }}"
                                        alt="{{ $waterPoint->name }}"
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
                            <td class="text-secondary">{{ $waterPoint->direction ?? '-' }}</td>
                            <td class="text-secondary">{{ $waterPoint->debit ?? '-' }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
