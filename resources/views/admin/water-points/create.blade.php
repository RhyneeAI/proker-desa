<x-layouts.admin title="Tambah Titik Air">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.titik-air.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.titik-air.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Informasi Titik Air</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama" name="name" placeholder="mis. Jaringan Pipa Blok A" required />
                    <x-form-textarea label="Alamat" name="address" :rows="2" />
                    <x-form-textarea label="Deskripsi" name="description" :rows="3" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Titik Koordinat</h3>
                </div>
                <div class="card-body">
                    <small class="text-secondary d-block mb-3">Ambil dari Google Maps: klik kanan lokasi → Salin koordinat. Koordinat tidak ditampilkan ke publik.</small>

                    @foreach ([
                        ['label' => 'Titik Awal', 'prefix' => 'start'],
                        ['label' => 'Titik Akhir', 'prefix' => 'end'],
                        ['label' => 'Titik Rekomendasi', 'prefix' => 'recommend'],
                    ] as $point)
                        <div class="mb-3">
                            <label class="form-label">{{ $point['label'] }}</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <x-form-input
                                        label="Latitude"
                                        name="{{ $point['prefix'] }}_latitude"
                                        type="number"
                                        step="0.0000001"
                                        placeholder="-6.821900"
                                    />
                                </div>
                                <div class="col-6">
                                    <x-form-input
                                        label="Longitude"
                                        name="{{ $point['prefix'] }}_longitude"
                                        type="number"
                                        step="0.0000001"
                                        placeholder="107.142500"
                                    />
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <x-form-input
                        label="Arah Lintasan"
                        name="direction"
                        placeholder="mis. Utara → Selatan"
                        hint="Arah jalur/lintasan jaringan air."
                    />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Foto Dokumentasi</h3>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <label class="form-label">Foto Dokumentasi</label>
                        <input type="file" name="documentation_photo" accept="image/*" class="form-control @error('documentation_photo') is-invalid @enderror">
                        <small class="form-hint">Format: JPG, PNG. Maks. 5MB.</small>
                        @error('documentation_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Foto Interpretasi (Plot)</h3>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <label class="form-label">Foto Interpretasi / Plot</label>
                        <input type="file" name="interpretation_photo" accept="image/*" class="form-control @error('interpretation_photo') is-invalid @enderror">
                        <small class="form-hint">Plot interpretasi alat AIDU (konfigurasi 0 dan 2). Format: JPG, PNG. Maks. 5MB.</small>
                        @error('interpretation_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.titik-air.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
