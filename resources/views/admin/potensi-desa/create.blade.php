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

                    <x-file-upload
                        name="image"
                        label="Gambar"
                        hint="Format: JPG, PNG. Maks. 2MB."
                    />

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
