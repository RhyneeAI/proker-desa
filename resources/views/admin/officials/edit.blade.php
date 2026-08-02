<x-layouts.admin title="Edit Aparatur Desa">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.aparatur.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.aparatur.update', $official) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Data Aparatur</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Lengkap" name="name" :value="$official->name" required />
                    <x-form-input label="Jabatan" name="position" :value="$official->position" required />
                    <x-form-input
                        label="Urutan Tampil"
                        name="display_order"
                        type="number"
                        :value="$official->display_order"
                        hint="Angka lebih kecil tampil lebih dulu."
                        required
                    />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Foto</h3>
                </div>
                <div class="card-body">
                    @if ($official->photo)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                            <img src="{{ Storage::url($official->photo) }}"
                                alt="{{ $official->photo_alt }}"
                                class="avatar avatar-xl rounded mb-2">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                        <small class="form-hint">Kosongkan jika tidak ingin mengganti foto.</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-input
                        label="Teks Alternatif Foto"
                        name="photo_alt"
                        :value="$official->photo_alt"
                    />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.aparatur.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
