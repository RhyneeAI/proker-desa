<x-layouts.admin title="Edit Potensi Desa">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.potensi.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi.update', $potential) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Potensi</h3>
                </div>
                <div class="card-body">
                    <x-form-input
                        label="Nama Potensi"
                        name="name"
                        :value="$potential->name"
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
                            value="{{ old('category', $potential->category) }}"
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
                        :value="$potential->description"
                        :rows="3"
                    />

                    <x-file-upload
                        name="photo"
                        label="Ganti Foto"
                        hint="Kosongkan jika tidak ingin mengganti foto."
                        :previews="$potential->photo ? [Storage::url($potential->photo)] : []"
                    />

                    <x-form-input
                        label="Teks Alternatif Foto"
                        name="photo_alt"
                        :value="$potential->photo_alt"
                    />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.potensi.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
