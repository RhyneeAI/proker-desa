<x-layouts.admin title="Edit Foto Galeri">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.galeri.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.galeri.update', $gallery) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Foto</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul Foto (opsional)" name="title" :value="$gallery->title" />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="['kegiatan' => 'Kegiatan', 'fasilitas' => 'Fasilitas', 'umkm' => 'UMKM', 'lainnya' => 'Lainnya']"
                        :selected="$gallery->category"
                        required
                    />

                    <x-file-upload
                        name="image"
                        label="Ganti Foto"
                        hint="Kosongkan jika tidak ingin mengganti foto."
                        :previews="$gallery->image ? [Storage::url($gallery->image)] : []"
                    />

                    <x-form-input label="Teks Alternatif" name="image_alt" :value="$gallery->image_alt" />
                    <x-form-textarea label="Deskripsi (opsional)" name="description" :value="$gallery->description" :rows="2" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
