<x-layouts.admin title="Edit Titik Air">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.titik-air.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.titik-air.update', $waterPoint) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Informasi Titik Air</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama" name="name" :value="$waterPoint->name" required />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="['Sumur' => 'Sumur', 'Pompa Air' => 'Pompa Air', 'Mata Air' => 'Mata Air', 'Hidran Umum' => 'Hidran Umum', 'Embung' => 'Embung', 'PAM' => 'PAM']"
                        :selected="$waterPoint->category"
                    />

                    <x-form-select
                        label="Status"
                        name="status"
                        :options="['Berfungsi' => 'Berfungsi', 'Rusak' => 'Rusak', 'Pemeliharaan' => 'Pemeliharaan']"
                        :selected="$waterPoint->status"
                    />

                    <x-form-textarea label="Alamat" name="address" :value="$waterPoint->address" :rows="2" />
                    <x-form-textarea label="Deskripsi" name="description" :value="$waterPoint->description" :rows="3" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Koordinat Lokasi</h3>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <x-form-input label="Latitude" name="latitude" :value="$waterPoint->latitude" type="number" step="0.0000001" />
                        </div>
                        <div class="col-6">
                            <x-form-input label="Longitude" name="longitude" :value="$waterPoint->longitude" type="number" step="0.0000001" />
                        </div>
                    </div>

                    @if ($waterPoint->latitude && $waterPoint->longitude)
                        <a href="https://www.google.com/maps?q={{ $waterPoint->latitude }},{{ $waterPoint->longitude }}"
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
                    @if ($waterPoint->photo)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                            <img src="{{ Storage::url($waterPoint->photo) }}"
                                alt="{{ $waterPoint->photo_alt }}"
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

                    <x-form-input label="Teks Alternatif Foto" name="photo_alt" :value="$waterPoint->photo_alt" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.titik-air.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
