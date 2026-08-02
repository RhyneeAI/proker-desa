<x-layouts.admin title="Tambah Fasilitas Umum">
    <div class="max-w-2xl">
        <div class="mb-6">
            <a href="{{ route('admin.fasilitas.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.fasilitas.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Informasi Fasilitas</h2>

                <x-form-input label="Nama Fasilitas" name="name" required />
                <x-form-textarea label="Deskripsi" name="description" :rows="3" />
                <x-form-textarea label="Alamat" name="address" :rows="2" />
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Koordinat Lokasi</h2>
                <p class="text-xs text-slate-500">Ambil dari Google Maps: klik kanan lokasi → Salin koordinat.</p>

                <div class="grid grid-cols-2 gap-4">
                    <x-form-input label="Latitude" name="latitude" placeholder="-6.821900" />
                    <x-form-input label="Longitude" name="longitude" placeholder="107.142500" />
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Foto</h2>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Foto Fasilitas</label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG. Maks. 2MB.</p>
                    @error('photo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Teks Alternatif Foto" name="photo_alt" placeholder="Deskripsi singkat foto" />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan
                </button>
                <a href="{{ route('admin.fasilitas.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>