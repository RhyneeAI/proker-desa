<x-layouts.admin title="Upload Foto Galeri">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.galeri.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
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

                    <x-file-upload
                        name="image"
                        label="Foto"
                        hint="Format: JPG, PNG."
                        required
                    />

                    <x-form-input
                        label="Teks Alternatif"
                        name="image_alt"
                        placeholder="Deskripsi singkat foto untuk aksesibilitas"
                    />

                    <x-form-textarea label="Deskripsi (opsional)" name="description" :rows="2" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Upload Foto</button>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
