<x-layouts.admin title="Tambah Aparatur Desa">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.aparatur.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.aparatur.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Data Aparatur</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Lengkap" name="name" required />
                    <x-form-input label="Jabatan" name="position" required />
                    <x-form-input
                        label="Urutan Tampil"
                        name="display_order"
                        type="number"
                        value="0"
                        hint="Angka lebih kecil tampil lebih dulu. Contoh: Kepala Desa = 1"
                        required
                    />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Foto</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Foto Aparatur</label>
                        <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                        <small class="form-hint">Format: JPG, PNG. Maks. 2MB.</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input
                        label="Teks Alternatif Foto"
                        name="photo_alt"
                        placeholder="Contoh: Foto Kepala Desa Cibulakan"
                    />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.aparatur.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
