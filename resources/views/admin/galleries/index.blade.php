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

    <div class="row g-3">
        @forelse ($galleries as $gallery)
            <div class="col-6 col-sm-4 col-lg-3">
                <div class="card">
                    <div class="position-relative">
                        <img src="{{ Storage::url($gallery->image) }}"
                            alt="{{ $gallery->image_alt ?? $gallery->title }}"
                            class="w-100 card-img-top object-fit-cover" style="height:9rem">
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-dark text-capitalize">
                                {{ $gallery->category }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-body fw-medium text-truncate mb-0">
                            {{ $gallery->title ?? 'Tanpa judul' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ route('admin.galeri.edit', $gallery) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.galeri.destroy', $gallery) }}"
                                onsubmit="return confirm('Hapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center text-secondary">
                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                <div>Belum ada foto di galeri.</div>
            </div>
        @endforelse
    </div>
</x-layouts.admin>
