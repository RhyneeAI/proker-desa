<x-layouts.admin title="Tambah Berita">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.berita.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Konten Berita</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul Berita" name="title" required />

                    <x-form-textarea
                        label="Isi Berita"
                        name="content"
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
                    <x-file-upload
                        name="thumbnail"
                        label="Gambar Thumbnail"
                        hint="Format: JPG, PNG. Maks. 2MB. Ukuran ideal: 800×450px."
                    />

                    <x-form-input
                        label="Teks Alternatif Thumbnail"
                        name="thumbnail_alt"
                        placeholder="Deskripsi singkat gambar"
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
                            {{ old('is_published') ? 'checked' : '' }}>
                        <label class="form-check-label">
                            <span class="d-block fw-medium">Terbitkan sekarang</span>
                            <small class="text-secondary d-block">Berita akan langsung tampil di halaman publik</small>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
