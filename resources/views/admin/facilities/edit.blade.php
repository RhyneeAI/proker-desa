<x-layouts.admin title="Edit Fasilitas Umum">
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.fasilitas.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.fasilitas.update', $facility) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Informasi Fasilitas</h2>

                <x-form-input label="Nama Fasilitas" name="name" :value="$facility->name" required />
                <x-form-textarea label="Deskripsi" name="description" :value="$facility->description" :rows="3" />
                <x-form-textarea label="Alamat" name="address" :value="$facility->address" :rows="2" />
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Koordinat Lokasi</h2>

                <div class="grid grid-cols-2 gap-4">
                    <x-form-input label="Latitude" name="latitude" :value="$facility->latitude" />
                    <x-form-input label="Longitude" name="longitude" :value="$facility->longitude" />
                </div>

                @if ($facility->latitude && $facility->longitude)
                    <a href="https://www.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}"
                        target="_blank"
                        class="text-sm text-[#192E03] hover:underline inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        Lihat lokasi saat ini di Google Maps
                    </a>
                @endif
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Foto</h2>

                @if ($facility->photo)
                    <div>
                        <p class="text-xs text-slate-500 mb-2">Foto saat ini:</p>
                        <img src="{{ Storage::url($facility->photo) }}"
                            alt="{{ $facility->photo_alt }}"
                            class="w-40 h-28 object-cover rounded-lg border border-slate-200">
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto</label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('photo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Teks Alternatif Foto" name="photo_alt" :value="$facility->photo_alt" />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.fasilitas.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>