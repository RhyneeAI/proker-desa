<x-layouts.admin title="Tambah UMKM">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.umkm.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.umkm.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Informasi Usaha</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Usaha" name="name" required />

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            list="kategori-list"
                            placeholder="mis. Kuliner, Kerajinan, Jasa"
                            class="form-control @error('category') is-invalid @enderror">
                        <datalist id="kategori-list">
                            <option value="Kuliner">
                            <option value="Kerajinan">
                            <option value="Jasa">
                            <option value="Pertanian">
                            <option value="Peternakan">
                            <option value="Perdagangan">
                        </datalist>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form-textarea label="Deskripsi" name="description" :rows="3" />
                    <x-form-input label="Nomor Telepon" name="phone" placeholder="08xxxxxxxxxx" />
                    <x-form-textarea label="Alamat" name="address" :rows="2" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Koordinat Lokasi</h3>
                </div>
                <div class="card-body">
                    <small class="text-secondary d-block mb-3">Ambil dari Google Maps: klik kanan lokasi → Salin koordinat.</small>

                    <div class="row g-3">
                        <div class="col-6">
                            <x-form-input
                                label="Latitude"
                                name="latitude"
                                placeholder="-6.821900"
                                hint="Contoh: -6.821900"
                            />
                        </div>
                        <div class="col-6">
                            <x-form-input
                                label="Longitude"
                                name="longitude"
                                placeholder="107.142500"
                                hint="Contoh: 107.142500"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Foto</h3>
                </div>
                <div class="card-body">
                    <x-file-upload
                        name="photo"
                        label="Foto Utama"
                        hint="Format: JPG, PNG."
                    />

                    <x-form-input label="Teks Alternatif Foto" name="photo_alt" placeholder="Deskripsi singkat foto" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Dokumentasi (lebih dari 1)</h3>
                </div>
                <div class="card-body">
                    <x-file-upload
                        name="documentation_photos[]"
                        label="Foto Dokumentasi"
                        :multiple="true"
                    />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
