<x-layouts.admin title="Edit Potensi Desa">
    <div class="max-w-xl">
        <div class="mb-6">
            <a href="{{ route('admin.potensi-desa.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi-desa.update', $potensiDesa) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Detail Potensi</h2>

                <x-form-input label="Nama Potensi" name="name" :value="$potensiDesa->name" required />

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
                    :selected="$potensiDesa->category"
                    required
                />

                <div>
                    @if ($potensiDesa->image)
                        <p class="text-xs text-slate-500 mb-2">Gambar saat ini:</p>
                        <img src="{{ Storage::url($potensiDesa->image) }}"
                            alt="{{ $potensiDesa->image_alt ?? $potensiDesa->name }}"
                            class="w-full h-48 object-cover rounded-lg border border-slate-200 mb-3">
                    @endif

                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Gambar</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Teks Alternatif" name="image_alt" :value="$potensiDesa->image_alt" />
                <x-form-textarea label="Deskripsi" name="description" :value="$potensiDesa->description" :rows="3" />
                <x-form-input label="Urutan Tampil" name="display_order" type="number" :value="$potensiDesa->display_order" />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.potensi-desa.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>
