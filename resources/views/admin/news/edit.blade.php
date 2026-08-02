<x-layouts.admin title="Edit Berita">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.berita.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.berita.update', $news) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Konten Berita</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul Berita" name="title" :value="$news->title" required />

                    <x-form-textarea
                        label="Isi Berita"
                        name="content"
                        :value="$news->content"
                        :rows="10"
                        required
                    />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Thumbnail</h3>
                </div>
                <div class="card-body">
                    @if ($news->thumbnail)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Thumbnail saat ini:</small>
                            <img src="{{ Storage::url($news->thumbnail) }}"
                                alt="{{ $news->thumbnail_alt }}"
                                class="img-fluid rounded mb-2">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Ganti Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*"
                            class="form-control @error('thumbnail') is-invalid @enderror">
                        <small class="form-hint">Kosongkan jika tidak ingin mengganti thumbnail.</small>
                        <img id="thumbnailPreview"
                            src="{{ $news->thumbnail && Storage::disk('public')->exists($news->thumbnail) ? Storage::url($news->thumbnail) : '' }}"
                            alt="{{ $news->thumbnail_alt ?? 'Pratinjau thumbnail' }}"
                            class="mt-3 img-fluid rounded border {{ $news->thumbnail ? '' : 'd-none' }}"
                            style="max-height:220px;object-fit:cover">
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input
                        label="Teks Alternatif Thumbnail"
                        name="thumbnail_alt"
                        :value="$news->thumbnail_alt"
                    />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Status Publikasi</h3>
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_published" value="1"
                            {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            <span class="d-block fw-medium">Diterbitkan</span>
                            <small class="text-secondary d-block">
                                @if ($news->published_at)
                                    Terbit sejak {{ $news->published_at->translatedFormat('d F Y, H:i') }}
                                @else
                                    Belum pernah diterbitkan
                                @endif
                            </small>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById('thumbnailInput').addEventListener('change', function () {
                const preview = document.getElementById('thumbnailPreview');
                if (this.files && this.files[0]) {
                    preview.src = URL.createObjectURL(this.files[0]);
                    preview.classList.remove('d-none');
                }
            });
        </script>
    @endpush
</x-layouts.admin>
