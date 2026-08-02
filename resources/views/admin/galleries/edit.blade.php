<x-layouts.admin title="Edit Foto Galeri">
    <div class="col-12 col-lg-8 col-xl-6">
        <div class="mb-3">
            <a href="{{ route('admin.galeri.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.galeri.update', $gallery) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
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

                    <div class="mb-3">
                        <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                        <img src="{{ Storage::url($gallery->image) }}"
                            alt="{{ $gallery->image_alt }}"
                            class="img-fluid rounded mb-3">

                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                        <small class="form-hint">Kosongkan jika tidak ingin mengganti foto.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input label="Teks Alternatif" name="image_alt" :value="$gallery->image_alt" />
                    <x-form-textarea label="Deskripsi (opsional)" name="description" :value="$gallery->description" :rows="2" />
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
