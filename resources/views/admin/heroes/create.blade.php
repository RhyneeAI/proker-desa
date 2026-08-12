<x-layouts.admin title="Tambah Slide Hero">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.hero.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Slide</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul (opsional)" name="title" placeholder="Contoh: Selamat Datang di Desa Cibulakan" />
                    <x-form-input label="Subjudul (opsional)" name="subtitle" placeholder="Contoh: Sumber informasi resmi desa" />

                    <x-file-upload
                        name="image"
                        label="Gambar Background"
                        hint="Format: JPG, PNG. Kosongkan untuk memakai gambar acak otomatis."
                    />

                    <x-form-input
                        label="Teks Alternatif"
                        name="image_alt"
                        placeholder="Deskripsi singkat gambar untuk aksesibilitas"
                    />

                    <x-form-input
                        label="Urutan"
                        name="sort_order"
                        type="number"
                        value="{{ old('sort_order', 0) }}"
                        hint="Semakin kecil, semakin awal tampil."
                    />

                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="active" value="1" checked>
                            <span class="form-check-label">Tampilkan slide ini di beranda</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Slide</button>
                <a href="{{ route('admin.hero.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
