<x-layouts.admin title="Upload Foto Galeri">
    <div class="col-12 col-lg-8 col-xl-6">
        <div class="mb-3">
            <a href="{{ route('admin.galeri.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Foto</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul Foto (opsional)" name="title" placeholder="Contoh: Kerja Bakti Desa" />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="['kegiatan' => 'Kegiatan', 'fasilitas' => 'Fasilitas', 'umkm' => 'UMKM', 'lainnya' => 'Lainnya']"
                        required
                    />

                    <div class="mb-3">
                        <label class="form-label">
                            Foto <span class="text-danger">*</span>
                        </label>
                        <div class="border rounded p-4 text-center bg-body-tertiary mb-2">
                            <i class="ti ti-photo d-block mx-auto mb-2 text-secondary" style="font-size: 2rem;"></i>
                            <p class="text-secondary mb-2">Klik untuk pilih foto</p>
                            <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                            <small class="text-secondary mt-2">Format: JPG, PNG. Maks. 2MB.</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input
                        label="Teks Alternatif"
                        name="image_alt"
                        placeholder="Deskripsi singkat foto untuk aksesibilitas"
                    />

                    <x-form-textarea label="Deskripsi (opsional)" name="description" :rows="2" />
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Upload Foto</button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
