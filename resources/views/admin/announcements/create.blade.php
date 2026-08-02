<x-layouts.admin title="Tambah Pengumuman">
    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('admin.pengumuman.index') }}" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.pengumuman.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3">Konten Pengumuman</h2>

                <x-form-input label="Judul Pengumuman" name="title" required />

                <x-form-textarea
                    label="Isi Pengumuman"
                    name="content"
                    :rows="8"
                    required
                />

                <x-form-input
                    label="Tenggat Waktu (opsional)"
                    name="deadline"
                    type="date"
                    hint="Kosongkan jika pengumuman tidak memiliki batas waktu berlaku."
                />
            </div>

            <div class="bg-white rounded-xl border border-slate-200 p-6">
                <h2 class="font-semibold text-[#192E03] text-sm border-b border-slate-100 pb-3 mb-4">Status Publikasi</h2>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-slate-300 text-[#192E03] focus:ring-[#192E03]">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Terbitkan sekarang</p>
                        <p class="text-xs text-slate-500">Pengumuman akan langsung tampil di halaman publik</p>
                    </div>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-5 py-2.5 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition">
                    Simpan
                </button>
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.admin>