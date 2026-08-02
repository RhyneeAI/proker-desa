<x-layouts.admin title="Kelola Profil Desa">
    <form method="POST" action="{{ route('admin.profil-desa.update') }}" enctype="multipart/form-data" class="max-w-3xl space-y-6">
        @csrf
        @method('PUT')

        {{-- Informasi Utama --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Informasi Utama</h2>

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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-textarea
                    label="Visi"
                    name="vision"
                    :value="$profile->vision"
                    :rows="3"
                />
                <x-form-textarea
                    label="Misi"
                    name="mission"
                    :value="$profile->mission"
                    :rows="3"
                />
            </div>

            <x-form-textarea
                label="Alamat"
                name="address"
                :value="$profile->address"
                :rows="2"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Luas Wilayah (km²)"
                    name="area_size"
                    type="number"
                    :value="$profile->area_size"
                    hint="Contoh: 12.50"
                />
                <x-form-input
                    label="Jumlah Penduduk (jiwa)"
                    name="population"
                    type="number"
                    :value="$profile->population"
                />
            </div>
        </div>

        {{-- Gambar --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Gambar</h2>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Logo Desa</label>
                @if ($profile->logo)
                    <img src="{{ Storage::url($profile->logo) }}" alt="{{ $profile->logo_alt }}" class="w-20 h-20 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-600">
                <p class="text-xs text-slate-500 mt-1">Maks. 2MB. Kosongkan jika tidak ingin mengubah.</p>
                @error('logo')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                <x-form-input label="Teks Alternatif Logo" name="logo_alt" :value="$profile->logo_alt" placeholder="Deskripsi singkat logo"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Cover</label>
                @if ($profile->cover_image)
                    <img src="{{ Storage::url($profile->cover_image) }}" alt="{{ $profile->cover_image_alt }}" class="w-full h-36 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="cover_image" accept="image/*" class="w-full text-sm text-slate-600">
                <p class="text-xs text-slate-500 mt-1">Maks. 4MB. Ukuran ideal 1920×480px.</p>
                @error('cover_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                <x-form-input label="Teks Alternatif Cover" name="cover_image_alt" :value="$profile->cover_image_alt" placeholder="Deskripsi singkat gambar cover"/>
            </div>
        </div>

        {{-- Batas Wilayah --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Batas Wilayah Desa</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form-input
                    label="Batas Utara"
                    name="border_north"
                    :value="$profile->border_north"
                    placeholder="Contoh: Desa Sukajadi"
                />
                <x-form-input
                    label="Batas Selatan"
                    name="border_south"
                    :value="$profile->border_south"
                    placeholder="Contoh: Desa Mekarjaya"
                />
                <x-form-input
                    label="Batas Timur"
                    name="border_east"
                    :value="$profile->border_east"
                    placeholder="Contoh: Desa Ciputri"
                />
                <x-form-input
                    label="Batas Barat"
                    name="border_west"
                    :value="$profile->border_west"
                    placeholder="Contoh: Desa Nagrak"
                />
            </div>
        </div>

        {{-- Bagan Struktur Organisasi --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Bagan Struktur Organisasi</h2>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Bagan Pemerintahan Desa</label>
                @if ($profile->org_chart_image)
                    <img src="{{ Storage::url($profile->org_chart_image) }}" alt="Bagan struktur organisasi desa"
                        class="w-full h-48 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="org_chart_image" accept="image/*" class="w-full text-sm text-slate-600">
                <p class="text-xs text-slate-500 mt-1">Maks. 4MB. Gambar bagan struktur organisasi pemerintahan desa.</p>
                @error('org_chart_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Bagan BPD</label>
                @if ($profile->bpd_chart_image)
                    <img src="{{ Storage::url($profile->bpd_chart_image) }}" alt="Bagan BPD"
                        class="w-full h-48 object-cover rounded-lg mb-2 border border-slate-200">
                @endif
                <input type="file" name="bpd_chart_image" accept="image/*" class="w-full text-sm text-slate-600">
                <p class="text-xs text-slate-500 mt-1">Maks. 4MB. Gambar bagan Badan Permusyawaratan Desa.</p>
                @error('bpd_chart_image')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Peta --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Peta Lokasi</h2>
            <x-form-textarea
                label="Embed Google Maps"
                name="map_embed"
                :value="$profile->map_embed"
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