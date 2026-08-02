<x-layouts.admin title="Kelola Profil Desa">
    <form method="POST" action="{{ route('admin.profil-desa.update') }}" enctype="multipart/form-data" class="col-12 col-xl-8 mx-auto">
        @csrf
        @method('PUT')

        {{-- Informasi Utama --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Informasi Utama</h3>
            </div>
            <div class="card-body">
                <x-form-input
                    label="Nama Desa"
                    name="village_name"
                    :value="$profile->village_name"
                    required
                />

                <x-form-textarea
                    label="Sejarah Desa"
                    name="history"
                    :value="$profile->history"
                    :rows="5"
                />

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form-textarea
                            label="Visi"
                            name="vision"
                            :value="$profile->vision"
                            :rows="3"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-textarea
                            label="Misi"
                            name="mission"
                            :value="$profile->mission"
                            :rows="3"
                        />
                    </div>
                </div>

                <x-form-textarea
                    label="Alamat"
                    name="address"
                    :value="$profile->address"
                    :rows="2"
                />

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form-input
                            label="Luas Wilayah (km²)"
                            name="area_size"
                            type="number"
                            :value="$profile->area_size"
                            hint="Contoh: 12.50"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            label="Jumlah Penduduk (jiwa)"
                            name="population"
                            type="number"
                            :value="$profile->population"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- Gambar --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Gambar</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Logo Desa</label>
                    @if ($profile->logo)
                        <img src="{{ Storage::url($profile->logo) }}" alt="{{ $profile->logo_alt }}" class="avatar avatar-xl rounded mb-2 d-block">
                    @endif
                    <input type="file" name="logo" accept="image/*" class="form-control @error('logo') is-invalid @enderror">
                    <small class="form-hint">Maks. 2MB. Kosongkan jika tidak ingin mengubah.</small>
                    @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <x-form-input label="Teks Alternatif Logo" name="logo_alt" :value="$profile->logo_alt" placeholder="Deskripsi singkat logo"/>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Cover</label>
                    @if ($profile->cover_image)
                        <img src="{{ Storage::url($profile->cover_image) }}" alt="{{ $profile->cover_image_alt }}" class="img-fluid rounded mb-2 d-block">
                    @endif
                    <input type="file" name="cover_image" accept="image/*" class="form-control @error('cover_image') is-invalid @enderror">
                    <small class="form-hint">Maks. 4MB. Ukuran ideal 1920×480px.</small>
                    @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <x-form-input label="Teks Alternatif Cover" name="cover_image_alt" :value="$profile->cover_image_alt" placeholder="Deskripsi singkat gambar cover"/>
                </div>
            </div>
        </div>

        {{-- Batas Wilayah --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Batas Wilayah Desa</h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form-input
                            label="Batas Utara"
                            name="border_north"
                            :value="$profile->border_north"
                            placeholder="Contoh: Desa Sukajadi"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            label="Batas Selatan"
                            name="border_south"
                            :value="$profile->border_south"
                            placeholder="Contoh: Desa Mekarjaya"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            label="Batas Timur"
                            name="border_east"
                            :value="$profile->border_east"
                            placeholder="Contoh: Desa Ciputri"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            label="Batas Barat"
                            name="border_west"
                            :value="$profile->border_west"
                            placeholder="Contoh: Desa Nagrak"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- Bagan Struktur Organisasi --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Bagan Struktur Organisasi</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Bagan Pemerintahan Desa</label>
                    @if ($profile->org_chart_image)
                        <img src="{{ Storage::url($profile->org_chart_image) }}" alt="Bagan struktur organisasi desa"
                            class="img-fluid rounded mb-2 d-block">
                    @endif
                    <input type="file" name="org_chart_image" accept="image/*" class="form-control @error('org_chart_image') is-invalid @enderror">
                    <small class="form-hint">Maks. 4MB. Gambar bagan struktur organisasi pemerintahan desa.</small>
                    @error('org_chart_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Bagan BPD</label>
                    @if ($profile->bpd_chart_image)
                        <img src="{{ Storage::url($profile->bpd_chart_image) }}" alt="Bagan BPD"
                            class="img-fluid rounded mb-2 d-block">
                    @endif
                    <input type="file" name="bpd_chart_image" accept="image/*" class="form-control @error('bpd_chart_image') is-invalid @enderror">
                    <small class="form-hint">Maks. 4MB. Gambar bagan Badan Permusyawaratan Desa.</small>
                    @error('bpd_chart_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Peta --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Peta Lokasi Desa</h3>
            </div>
            <div class="card-body">
                <x-form-textarea
                    label="Embed Google Maps — Lokasi Desa"
                    name="map_embed"
                    :value="$profile->map_embed"
                    :rows="3"
                    placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
                />
                <small class="text-secondary d-block">Peta ini akan tampil di halaman <strong>Profil Desa</strong> (section Peta Lokasi Desa). Ambil dari Google Maps → Bagikan → Sematkan peta → Salin kode iframe.</small>
            </div>
        </div>

        <div class="d-flex gap-3 mt-3">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-layouts.admin>
