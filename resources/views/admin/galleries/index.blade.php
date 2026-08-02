<x-layouts.admin title="Kelola Galeri">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Galeri Foto</h2>
            <p class="text-secondary mb-0">Kelola dokumentasi foto desa</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Upload Foto
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                        @php
                            $img = $gallery->image && Storage::disk('public')->exists($gallery->image)
                                ? Storage::url($gallery->image)
                                : 'https://picsum.photos/seed/gallery-' . $gallery->id . '/120/80';
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ $img }}" alt="{{ $gallery->image_alt ?? $gallery->title }}"
                                    class="rounded" style="width:72px;height:48px;object-fit:cover">
                            </td>
                            <td class="fw-medium text-body">{{ $gallery->title ?? 'Tanpa judul' }}</td>
                            <td><span class="badge bg-secondary text-capitalize">{{ $gallery->category }}</span></td>
                            <td class="text-secondary">{{ Str::limit($gallery->description, 60) }}</td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.galeri.edit', $gallery) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.galeri.destroy', $gallery) }}"
                                        onsubmit="return confirm('Hapus foto ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
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
