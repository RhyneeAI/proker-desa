<x-layouts.admin title="Edit UMKM">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.umkm.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.umkm.update', $umkm) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Informasi Usaha</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama Usaha" name="name" :value="$umkm->name" required />
                    <x-form-input label="Nama Pemilik" name="owner_name" :value="$umkm->owner_name" required />

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $umkm->category) }}"
                            list="kategori-list"
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

                    <x-form-textarea label="Deskripsi" name="description" :value="$umkm->description" :rows="3" />
                    <x-form-input label="Nomor Telepon" name="phone" :value="$umkm->phone" />
                    <x-form-textarea label="Alamat" name="address" :value="$umkm->address" :rows="2" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Koordinat Lokasi</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <x-form-input label="Latitude" name="latitude" :value="$umkm->latitude" />
                        </div>
                        <div class="col-6">
                            <x-form-input label="Longitude" name="longitude" :value="$umkm->longitude" />
                        </div>
                    </div>

                    @if ($umkm->latitude && $umkm->longitude)
                        <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                            target="_blank"
                            class="link-primary text-decoration-none">
                            <i class="ti ti-map-pin me-1"></i> Lihat lokasi saat ini di Google Maps
                        </a>
                    @endif
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
                        hint="Kosongkan jika tidak ingin mengganti foto."
                        :previews="$umkm->photo ? [Storage::url($umkm->photo)] : []"
                    />

                    <x-form-input label="Teks Alternatif Foto" name="photo_alt" :value="$umkm->photo_alt" />
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
                        :previews="$umkm->documentation_photos ? collect($umkm->documentation_photos)->map(fn ($p) => Storage::url($p))->values()->all() : []"
                    />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
