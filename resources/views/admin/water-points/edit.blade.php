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
                    <x-form-textarea label="Alamat" name="address" :value="$waterPoint->address" :rows="2" />
                    <x-form-textarea label="Deskripsi" name="description" :value="$waterPoint->description" :rows="3" />
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Titik Koordinat</h3>
                </div>
                <div class="card-body">
                    <small class="text-secondary d-block mb-3">Koordinat tidak ditampilkan ke publik.</small>

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
                                        :value="$waterPoint->{$point['prefix'].'_latitude'}"
                                        type="number"
                                        step="0.0000001"
                                        placeholder="-6.821900"
                                    />
                                </div>
                                <div class="col-6">
                                    <x-form-input
                                        label="Longitude"
                                        name="{{ $point['prefix'] }}_longitude"
                                        :value="$waterPoint->{$point['prefix'].'_longitude'}"
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
                        :value="$waterPoint->direction"
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
                    @if ($waterPoint->documentation_photo)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                            <img src="{{ Storage::url($waterPoint->documentation_photo) }}"
                                alt="{{ $waterPoint->name }}"
                                class="img-fluid rounded mb-2" style="max-height:220px;object-fit:cover">
                        </div>
                    @endif

                    <div class="mb-0">
                        <label class="form-label">Ganti Foto Dokumentasi</label>
                        <input type="file" name="documentation_photo" accept="image/*" class="form-control @error('documentation_photo') is-invalid @enderror">
                        <small class="form-hint">Kosongkan jika tidak ingin mengganti. Maks. 5MB.</small>
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
                    @if ($waterPoint->interpretation_photo)
                        <div class="mb-3">
                            <small class="text-secondary d-block mb-2">Foto saat ini:</small>
                            <img src="{{ Storage::url($waterPoint->interpretation_photo) }}"
                                alt="{{ $waterPoint->name }}"
                                class="img-fluid rounded mb-2" style="max-height:220px;object-fit:cover">
                        </div>
                    @endif

                    <div class="mb-0">
                        <label class="form-label">Ganti Foto Interpretasi / Plot</label>
                        <input type="file" name="interpretation_photo" accept="image/*" class="form-control @error('interpretation_photo') is-invalid @enderror">
                        <small class="form-hint">Plot interpretasi alat AIDU (konfigurasi 0 dan 2). Kosongkan jika tidak ingin mengganti. Maks. 5MB.</small>
                        @error('interpretation_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.titik-air.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
