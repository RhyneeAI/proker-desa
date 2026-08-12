<x-layouts.admin title="Kelola Hero Slider">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Hero Slider</h2>
            <p class="text-secondary mb-0">Kelola gambar slider pada halaman beranda</p>
        </div>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Slide
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th class="w-1 text-center">No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Subjudul</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($heroSlides as $heroSlide)
                        @php
                            $img = $heroSlide->image && Storage::disk('public')->exists($heroSlide->image)
                                ? Storage::url($heroSlide->image)
                                : 'https://picsum.photos/seed/hero-' . $heroSlide->id . '/160/90';
                        @endphp
                        <tr>
                            <td class="text-center text-secondary">{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $img }}" data-lightbox="{{ $img }}" alt="{{ $heroSlide->image_alt ?? $heroSlide->title }}"
                                    class="rounded" style="width:96px;height:54px;object-fit:cover">
                            </td>
                            <td class="fw-medium text-body">{{ $heroSlide->title ?? 'Tanpa judul' }}</td>
                            <td class="text-secondary">{{ Str::limit($heroSlide->subtitle, 60) }}</td>
                            <td class="text-center">
                                <span class="fw-semibold text-secondary">{{ $heroSlide->sort_order }}</span>
                            </td>
                            <td class="text-center">
                                @if ($heroSlide->active)
                                    <span class="badge text-white shadow-sm bg-success"><span class="status-dot me-1"></span>Aktif</span>
                                @else
                                    <span class="badge text-white shadow-sm bg-warning"><span class="status-dot me-1"></span>Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.hero.edit', $heroSlide) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.hero.destroy', $heroSlide) }}"
                                        data-confirm="Hapus slide ini?" data-item="slide ini">
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
