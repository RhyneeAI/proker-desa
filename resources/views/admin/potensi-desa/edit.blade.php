<x-layouts.admin title="Edit Potensi Desa">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.potensi-desa.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi-desa.update', $potensiDesa) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Potensi</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Potensi" name="name" :value="$potensiDesa->name" required />

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
                        :selected="$potensiDesa->category"
                        required
                    />

                    <x-file-upload
                        name="image"
                        label="Ganti Gambar"
                        hint="Kosongkan jika tidak ingin mengganti gambar."
                        :previews="$potensiDesa->image ? [Storage::url($potensiDesa->image)] : []"
                    />

                    <x-form-input label="Teks Alternatif" name="image_alt" :value="$potensiDesa->image_alt" />
                    <x-form-textarea label="Deskripsi" name="description" :value="$potensiDesa->description" :rows="3" />
                    <x-form-input label="Urutan Tampil" name="display_order" type="number" :value="$potensiDesa->display_order" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.potensi-desa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
