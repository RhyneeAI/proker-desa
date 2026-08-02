<x-layouts.admin title="Tambah Potensi Desa">
    <div class="max-w-xl">
        <div class="mb-6">
            <a href="{{ route('admin.potensi-desa.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi-desa.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Detail Potensi</h2>

                <x-form-input label="Nama Potensi" name="name" placeholder="Contoh: Agrowisata Sawah" required />

                <x-form-select
                    label="Kategori"
                    name="category"
                    :options="[
                        'pertanian' => 'Pertanian',
                        'wisata' => 'Wisata',
                        'alam' => 'Sumber Daya Alam',
                        'ekonomi' => 'Ekonomi',
                        'budaya' => 'Budaya',
                        'lainnya' => 'Lainnya',
                    ]"
                    required
                />

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Gambar
                    </label>
                    <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-[#192E03]/50 transition">
                        <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-slate-500 mb-2">Klik untuk pilih gambar</p>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600">
                        <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG. Maks. 2MB.</p>
                    </div>
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Teks Alternatif" name="image_alt" placeholder="Deskripsi singkat gambar" />

                <x-form-textarea label="Deskripsi" name="description" :rows="3" placeholder="Jelaskan potensi desa ini" />

                <x-form-input label="Urutan Tampil" name="display_order" type="number" value="0" hint="Semakin kecil angkanya, tampil lebih dulu" />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan
                </button>
                <a href="{{ route('admin.potensi-desa.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>
