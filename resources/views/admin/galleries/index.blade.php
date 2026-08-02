<x-layouts.admin title="Kelola Galeri">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Galeri Foto</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola dokumentasi foto desa</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload Foto
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($galleries as $gallery)
            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="{{ Storage::url($gallery->image) }}"
                        alt="{{ $gallery->image_alt ?? $gallery->title }}"
                        class="w-full h-36 object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute top-2 left-2">
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-black/50 text-white capitalize">
                            {{ $gallery->category }}
                        </span>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-sm font-medium text-slate-800 truncate">
                        {{ $gallery->title ?? 'Tanpa judul' }}
                    </p>
                    <div class="flex justify-between items-center mt-2">
                        <a href="{{ route('admin.galeri.edit', $gallery) }}"
                            class="text-xs text-[#192E03] hover:underline font-medium">Edit</a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $gallery) }}"
                            onsubmit="return confirm('Hapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 hover:underline font-medium">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-500">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Belum ada foto di galeri.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>
</x-layouts.admin>