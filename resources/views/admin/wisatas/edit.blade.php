<x-layouts.admin title="Edit Wisata">
    <div class="col-12 col-lg-8 col-xl-6">
        <div class="mb-3">
            <a href="{{ route('admin.wisata.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.wisata.update', $wisata) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Wisata</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama" name="name" :value="$wisata->name" required />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="['Alam', 'Budaya', 'Religi', 'Kuliner', 'Edukasi', 'Lainnya']"
                        :selected="old('category', $wisata->category)"
                    />

                    <x-form-textarea label="Alamat" name="address" :value="$wisata->address" :rows="2" />
                    <x-form-input label="Jam Buka" name="opening_hours" :value="$wisata->opening_hours" />
                    <x-form-input label="Harga Tiket" name="ticket_price" :value="$wisata->ticket_price" />
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Koordinat Lokasi</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <x-form-input label="Latitude" name="latitude" type="number" step="0.0000001" :value="$wisata->latitude" />
                        </div>
                        <div class="col-6">
                            <x-form-input label="Longitude" name="longitude" type="number" step="0.0000001" :value="$wisata->longitude" />
                        </div>
                    </div>

                    @if ($wisata->latitude && $wisata->longitude)
                        <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}"
                            target="_blank"
                            class="link-primary text-decoration-none">
                            <i class="ti ti-map-pin me-1"></i> Lihat lokasi saat ini di Google Maps
                        </a>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Deskripsi &amp; Foto</h3>
                </div>
                <div class="card-body">
                    <x-form-textarea label="Deskripsi" name="description" :value="$wisata->description" :rows="3" />

                    @if ($wisata->photo)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                            <img src="{{ Storage::url($wisata->photo) }}"
                                alt="{{ $wisata->photo_alt }}"
                                class="img-fluid rounded mb-2">
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

                    <x-form-input label="Teks Alternatif Foto" name="photo_alt" :value="$wisata->photo_alt" />
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.wisata.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
