<x-layouts.admin title="Kelola Kontak">
    <form method="POST" action="{{ route('admin.kontak.update') }}" class="col-12 col-xl-8 mx-auto">
        @csrf
        @method('PUT')

        {{-- Informasi Kontak --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Informasi Kontak</h3>
            </div>
            <div class="card-body">
                <x-form-textarea
                    label="Alamat Kantor"
                    name="address"
                    :value="$contact->address"
                    :rows="2"
                    required
                />

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-form-input
                            label="Nomor Telepon"
                            name="phone"
                            :value="$contact->phone"
                            placeholder="0263xxxxxx"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-form-input
                            label="Nomor WhatsApp"
                            name="whatsapp"
                            :value="$contact->whatsapp"
                            placeholder="0812xxxxxxxx"
                        />
                    </div>
                </div>

                <x-form-input
                    label="Email"
                    name="email"
                    type="email"
                    :value="$contact->email"
                    placeholder="desa@example.id"
                />

                <x-form-input
                    label="Jam Layanan"
                    name="office_hours"
                    :value="$contact->office_hours"
                    placeholder="Senin–Jumat, 08:00–15:00 WIB"
                />
            </div>
        </div>

        {{-- Media Sosial --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Media Sosial</h3>
            </div>
            <div class="card-body">
                <x-form-input
                    label="Facebook"
                    name="facebook"
                    :value="$contact->facebook"
                    placeholder="https://facebook.com/desasukamaju"
                />
                <x-form-input
                    label="Instagram"
                    name="instagram"
                    :value="$contact->instagram"
                    placeholder="https://instagram.com/desasukamaju"
                />
                <x-form-input
                    label="YouTube"
                    name="youtube"
                    :value="$contact->youtube"
                    placeholder="https://youtube.com/@desasukamaju"
                />
                <x-form-input
                    label="TikTok"
                    name="tiktok"
                    :value="$contact->tiktok"
                    placeholder="https://tiktok.com/@desasukamaju"
                />
            </div>
        </div>

        {{-- Peta --}}
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Peta Lokasi Kantor</h3>
            </div>
            <div class="card-body">
                <x-form-textarea
                    label="Embed Google Maps — Lokasi Kantor"
                    name="map_embed"
                    :value="$contact->map_embed"
                    :rows="3"
                    placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
                />
                <small class="text-secondary d-block">Peta ini akan tampil di halaman <strong>Kontak</strong>. Ambil dari Google Maps → Bagikan → Sematkan peta → Salin kode iframe.</small>
            </div>
        </div>

        <div class="d-flex gap-3 mt-3">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-layouts.admin>
