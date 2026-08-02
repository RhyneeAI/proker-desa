<x-layouts.admin title="Tambah Potensi Desa">
    <div class="col-12 col-lg-8 col-xl-6">
        <div class="mb-3">
            <a href="{{ route('admin.potensi.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Potensi</h3>
                </div>
                <div class="card-body">
                    <x-form-input
                        label="Nama Potensi"
                        name="name"
                        placeholder="Contoh: Kebun Teh"
                        required
                    />

                    <div class="mb-3">
                        <label for="category" class="form-label">
                            Kategori
                        </label>
                        <input
                            type="text"
                            name="category"
                            id="category"
                            value="{{ old('category') }}"
                            list="category-options"
                            placeholder="Pilih atau ketik kategori"
                            class="form-control @error('category') is-invalid @enderror"
                        >
                        <datalist id="category-options">
                            <option value="Pertanian"></option>
                            <option value="Pariwisata"></option>
                            <option value="Kerajinan"></option>
                            <option value="Peternakan"></option>
                            <option value="Perkebunan"></option>
                        </datalist>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-textarea
                        label="Deskripsi"
                        name="description"
                        :rows="3"
                        placeholder="Jelaskan potensi desa ini"
                    />

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <div class="border rounded p-4 text-center bg-body-tertiary mb-2">
                            <i class="ti ti-photo d-block mx-auto mb-2 text-secondary" style="font-size: 2rem;"></i>
                            <p class="text-secondary mb-2">Klik untuk pilih foto</p>
                            <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                            <small class="text-secondary mt-2">Format: JPG, PNG. Maks. 2MB.</small>
                        </div>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input
                        label="Teks Alternatif Foto"
                        name="photo_alt"
                        placeholder="Deskripsi singkat foto untuk aksesibilitas"
                    />
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.potensi.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
