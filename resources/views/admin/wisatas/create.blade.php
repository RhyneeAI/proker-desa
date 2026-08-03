<x-layouts.admin title="Tambah Wisata">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.wisata.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.wisata.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Informasi Wisata</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Nama" name="name" required />

                    <x-form-select
                        label="Kategori"
                        name="category"
                        :options="['Alam', 'Budaya', 'Religi', 'Kuliner', 'Edukasi', 'Lainnya']"
                        :selected="old('category')"
                    />

                    <x-form-textarea label="Alamat" name="address" :rows="2" />
                    <x-form-input label="Jam Buka" name="opening_hours" placeholder="mis. 08.00 - 17.00 WIB" />
                    <x-form-input label="Harga Tiket" name="ticket_price" placeholder="mis. Gratis, Rp 10.000" />
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
                                type="number"
                                step="0.0000001"
                                placeholder="-7.250445"
                                hint="Contoh: -7.250445"
                            />
                        </div>
                        <div class="col-6">
                            <x-form-input
                                label="Longitude"
                                name="longitude"
                                type="number"
                                step="0.0000001"
                                placeholder="107.900000"
                                hint="Contoh: 107.900000"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Deskripsi &amp; Foto</h3>
                </div>
                <div class="card-body">
                    <x-form-textarea label="Deskripsi" name="description" :rows="3" />

                    <x-file-upload
                        name="photo"
                        label="Foto"
                        hint="Format: JPG, PNG. Maks. 2MB."
                    />

                    <x-form-input label="Teks Alternatif Foto" name="photo_alt" placeholder="Deskripsi singkat foto" />
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.wisata.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.querySelector('input[name="ticket_price"]')?.addEventListener('input', function () {
                var digits = this.value.replace(/\D/g, '');
                this.value = digits ? Number(digits).toLocaleString('id-ID') : '';
            });
        </script>
    @endpush
</x-layouts.admin>
