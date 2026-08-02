<x-layouts.admin title="Kelola Pengumuman">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Pengumuman</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola pengumuman resmi desa</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pengumuman
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 text-left border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Judul</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Tenggat Waktu</th>
                    <th class="px-4 py-3 font-medium">Tanggal Terbit</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($announcements as $announcement)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-800 line-clamp-1">{{ $announcement->title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $announcement->slug }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                {{ $announcement->is_published ? 'bg-[#192E03]/20 text-[#192E03]' : 'bg-slate-100 text-slate-600' }}">
                                {{ $announcement->is_published ? 'Terbit' : 'Draf' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if ($announcement->deadline)
                                <span class="text-xs {{ $announcement->deadline->isPast() ? 'text-red-600' : 'text-amber-600' }}">
                                    {{ $announcement->deadline->translatedFormat('d F Y') }}
                                    {{ $announcement->deadline->isPast() ? '(Kedaluwarsa)' : '' }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400">Tanpa batas waktu</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600 text-xs">
                            {{ $announcement->published_at?->translatedFormat('d F Y') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.pengumuman.edit', $announcement) }}"
                                    class="px-3 py-1.5 text-xs font-medium text-[#192E03] bg-[#192E03]/10 rounded-lg hover:bg-[#192E03]/20 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.pengumuman.destroy', $announcement) }}"
                                    onsubmit="return confirm('Hapus pengumuman ini?');">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-2.236 9.168-5.5"/>
                            </svg>
                            Belum ada pengumuman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $announcements->links() }}
    </div>
</x-layouts.admin>