<x-layouts.admin title="Kelola Berita">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">Berita</h2>
            <p class="text-secondary mb-0">Kelola artikel berita desa</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah Berita
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Terbit</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsList as $news)
                        <tr>
                            <td>
                                @if ($news->thumbnail)
                                    <img src="{{ Storage::url($news->thumbnail) }}" data-lightbox="{{ Storage::url($news->thumbnail) }}"
                                        alt="{{ $news->thumbnail_alt }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-photo text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body text-truncate mb-0">{{ $news->title }}</p>
                                <p class="text-secondary small mb-0">{{ $news->slug }}</p>
                            </td>
                            <td>
                                <span class="badge text-white {{ $news->is_published ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $news->is_published ? 'Terbit' : 'Draf' }}
                                </span>
                            </td>
                            <td class="text-secondary text-nowrap">
                                {{ $news->published_at?->translatedFormat('d F Y') ?? '-' }}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <form method="POST" action="{{ route('admin.berita.toggle', $news) }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-icon {{ $news->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                            title="{{ $news->is_published ? 'Turunkan (unpublish)' : 'Terbitkan' }}">
                                            <i class="ti {{ $news->is_published ? 'ti-eye-off' : 'ti-eye' }}"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.berita.edit', $news) }}" class="btn btn-icon btn-outline-primary" title="Edit"><i class="ti ti-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.berita.destroy', $news) }}"
                                        onsubmit="return confirm('Hapus berita ini?');">
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
