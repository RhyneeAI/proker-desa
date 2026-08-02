<x-layouts.admin title="Kelola Kontak">
    <form method="POST" action="{{ route('admin.kontak.update') }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        {{-- Informasi Kontak --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Informasi Kontak</h2>

            <x-form-textarea
                label="Alamat Kantor"
                name="address"
                :value="$contact->address"
                :rows="2"
                required
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Nomor Telepon"
                    name="phone"
                    :value="$contact->phone"
                    placeholder="0263xxxxxx"
                />
                <x-form-input
                    label="Nomor WhatsApp"
                    name="whatsapp"
                    :value="$contact->whatsapp"
                    placeholder="0812xxxxxxxx"
                />
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

        {{-- Media Sosial --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Media Sosial</h2>

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
        </div>

        {{-- Peta --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Peta Lokasi</h2>
            <x-form-textarea
                label="Embed Google Maps"
                name="map_embed"
                :value="$contact->map_embed"
                :rows="3"
                placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'
            />
            <p class="text-xs text-slate-500">Ambil dari Google Maps → Bagikan → Sematkan peta → Salin kode iframe.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                Batal
            </a>
        </div>
    </form>
</x-layouts.admin>