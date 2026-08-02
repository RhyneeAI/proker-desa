<x-layouts.admin title="Kelola Berita">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Berita</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola artikel berita desa</p>
        </div>
        <a href="{{ route('admin.berita.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 text-left border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Thumbnail</th>
                    <th class="px-4 py-3 font-medium">Judul</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Tanggal Terbit</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($newsList as $news)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            @if ($news->thumbnail)
                                <img src="{{ Storage::url($news->thumbnail) }}"
                                    alt="{{ $news->thumbnail_alt }}"
                                    class="w-16 h-11 rounded-lg object-cover border border-slate-200">
                            @else
                                <div class="w-16 h-11 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-800 line-clamp-1">{{ $news->title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $news->slug }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                {{ $news->is_published ? 'bg-[#192E03]/20 text-[#192E03]' : 'bg-slate-100 text-slate-600' }}">
                                {{ $news->is_published ? 'Terbit' : 'Draf' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-600 text-xs">
                            {{ $news->published_at?->translatedFormat('d F Y') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.berita.edit', $news) }}"
                                    class="px-3 py-1.5 text-xs font-medium text-[#192E03] bg-[#192E03]/10 rounded-lg hover:bg-[#192E03]/20 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.berita.destroy', $news) }}"
                                    onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center text-slate-500">
                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v8a2 2 0 01-2 2z"/>
                            </svg>
                            Belum ada berita.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $newsList->links() }}
    </div>
</x-layouts.admin>