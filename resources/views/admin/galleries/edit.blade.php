<x-layouts.admin title="Edit Foto Galeri">
    <div class="max-w-xl">
        <div class="mb-6">
            <a href="{{ route('admin.galeri.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.galeri.update', $gallery) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Detail Foto</h2>

                <x-form-input label="Judul Foto (opsional)" name="title" :value="$gallery->title" />

                <x-form-select
                    label="Kategori"
                    name="category"
                    :options="['kegiatan' => 'Kegiatan', 'fasilitas' => 'Fasilitas', 'umkm' => 'UMKM', 'lainnya' => 'Lainnya']"
                    :selected="$gallery->category"
                    required
                />

                <div>
                    <p class="text-xs text-slate-500 mb-2">Foto saat ini:</p>
                    <img src="{{ Storage::url($gallery->image) }}"
                        alt="{{ $gallery->image_alt }}"
                        class="w-full h-48 object-cover rounded-lg border border-slate-200 mb-3">

                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input label="Teks Alternatif" name="image_alt" :value="$gallery->image_alt" />
                <x-form-textarea label="Deskripsi (opsional)" name="description" :value="$gallery->description" :rows="2" />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.galeri.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>