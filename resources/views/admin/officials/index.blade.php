<x-layouts.admin title="Kelola Aparatur Desa">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Aparatur Desa</h2>
            <p class="text-secondary mb-0">Kelola data perangkat dan aparatur desa</p>
        </div>
        <a href="{{ route('admin.aparatur.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Aparatur
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
                        <th>Jabatan</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($officials as $official)
                        <tr>
                            <td class="text-secondary">{{ $loop->iteration }}</td>
                            <td>
                                @if ($official->photo)
                                    <img src="{{ Storage::url($official->photo) }}" data-lightbox="{{ Storage::url($official->photo) }}"
                                        alt="{{ $official->photo_alt }}"
                                        class="avatar avatar-sm rounded">
                                @else
                                    <span class="avatar avatar-sm bg-secondary-lt"><i class="ti ti-user text-secondary"></i></span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $official->name }}</p>
                            </td>
                            <td class="text-secondary">{{ $official->position }}</td>
                            <td class="text-center">
                                <span class="fw-semibold text-secondary">{{ $official->display_order }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.aparatur.edit', $official) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.aparatur.destroy', $official) }}"
                                        onsubmit="return confirm('Hapus data aparatur ini?');">
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
