<x-layouts.admin title="Edit Potensi Desa">
    <div class="max-w-xl">
        <div class="mb-6">
            <a href="{{ route('admin.potensi.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.potensi.update', $potential) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Detail Potensi</h2>

                <x-form-input
                    label="Nama Potensi"
                    name="name"
                    :value="$potential->name"
                    required
                />

                <div>
                    <label for="category" class="block text-sm font-medium text-slate-700 mb-1">
                        Kategori
                    </label>
                    <input
                        type="text"
                        name="category"
                        id="category"
                        value="{{ old('category', $potential->category) }}"
                        list="category-options"
                        placeholder="Pilih atau ketik kategori"
                        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm
                               @error('category') border-red-400 @enderror"
                    >
                    <datalist id="category-options">
                        <option value="Pertanian"></option>
                        <option value="Pariwisata"></option>
                        <option value="Kerajinan"></option>
                        <option value="Peternakan"></option>
                        <option value="Perkebunan"></option>
                    </datalist>
                    @error('category')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-textarea
                    label="Deskripsi"
                    name="description"
                    :value="$potential->description"
                    :rows="3"
                />

                <div>
                    @if ($potential->photo)
                        <p class="text-xs text-slate-500 mb-2">Foto saat ini:</p>
                        <img src="{{ Storage::url($potential->photo) }}"
                            alt="{{ $potential->photo_alt ?? $potential->name }}"
                            class="w-full h-48 object-cover rounded-lg border border-slate-200 mb-3">
                    @endif

                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Foto</label>
                    <input type="file" name="photo" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti foto.</p>
                    @error('photo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input
                    label="Teks Alternatif Foto"
                    name="photo_alt"
                    :value="$potential->photo_alt"
                />
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.potensi.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>
