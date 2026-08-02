<x-layouts.admin title="Edit Berita">
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.berita.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.berita.update', $news) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Konten Berita</h2>

                <x-form-input label="Judul Berita" name="title" :value="$news->title" required />

                <x-form-textarea
                    label="Isi Berita"
                    name="content"
                    :value="$news->content"
                    :rows="10"
                    required
                />
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Thumbnail</h2>

                @if ($news->thumbnail)
                    <div>
                        <p class="text-xs text-slate-500 mb-2">Thumbnail saat ini:</p>
                        <img src="{{ Storage::url($news->thumbnail) }}"
                            alt="{{ $news->thumbnail_alt }}"
                            class="w-40 h-28 object-cover rounded-lg border border-slate-200">
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ganti Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-sm text-slate-600">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengganti thumbnail.</p>
                    @error('thumbnail')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-input
                    label="Teks Alternatif Thumbnail"
                    name="thumbnail_alt"
                    :value="$news->thumbnail_alt"
                />
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3 mb-4">Status Publikasi</h2>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-[#192E03] focus:ring-[#192E03]">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Diterbitkan</p>
                        <p class="text-xs text-slate-500">
                            @if ($news->published_at)
                                Terbit sejak {{ $news->published_at->translatedFormat('d F Y, H:i') }}
                            @else
                                Belum pernah diterbitkan
                            @endif
                        </p>
                    </div>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.berita.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>