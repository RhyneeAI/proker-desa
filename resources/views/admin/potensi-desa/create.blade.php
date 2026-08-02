<x-layouts.admin title="Tambah Potensi Desa">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.potensi-desa.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi-desa.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Potensi</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Potensi" name="name" placeholder="Contoh: Agrowisata Sawah" required />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="[
                            'pertanian' => 'Pertanian',
                            'wisata' => 'Wisata',
                            'alam' => 'Sumber Daya Alam',
                            'ekonomi' => 'Ekonomi',
                            'budaya' => 'Budaya',
                            'lainnya' => 'Lainnya',
                        ]"
                        required
                    />

                    <div class="mb-3">
                        <label class="form-label">
                            Gambar
                        </label>
                        <div class="border rounded p-4 text-center bg-body-tertiary mb-2">
                            <i class="ti ti-photo d-block mx-auto mb-2 text-secondary" style="font-size: 2rem;"></i>
                            <p class="text-secondary mb-2">Klik untuk pilih gambar</p>
                            <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                            <small class="text-secondary mt-2">Format: JPG, PNG. Maks. 2MB.</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input label="Teks Alternatif" name="image_alt" placeholder="Deskripsi singkat gambar" />

                    <x-form-textarea label="Deskripsi" name="description" :rows="3" placeholder="Jelaskan potensi desa ini" />

                    <x-form-input label="Urutan Tampil" name="display_order" type="number" value="0" hint="Semakin kecil angkanya, tampil lebih dulu" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.potensi-desa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
