<x-layouts.admin title="Kelola Potensi Desa">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Potensi Desa</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola potensi dan kekayaan desa</p>
        </div>
        <a href="{{ route('admin.potensi.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Potensi
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Potensi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($potentials as $potential)
                    <tr>
                        <td class="px-6 py-4">
                            @if ($potential->photo)
                                <img src="{{ Storage::url($potential->photo) }}"
                                    alt="{{ $potential->photo_alt ?? $potential->name }}"
                                    class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-[#192E03]/10 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-800">{{ $potential->name }}</p>
                            @if ($potential->description)
                                <p class="text-xs text-slate-500 truncate max-w-xs mt-0.5">{{ Str::limit($potential->description, 60) }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($potential->category)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-[#192E03]/10 text-[#192E03] capitalize">
                                    {{ $potential->category }}
                                </span>
                            @else
                                <span class="text-xs text-slate-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.potensi.edit', $potential) }}"
                                    class="text-xs text-[#192E03] hover:underline font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.potensi.destroy', $potential) }}"
                                    onsubmit="return confirm('Hapus potensi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-600 hover:underline font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-slate-500">
                            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                            </svg>
                            Belum ada data potensi desa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $potentials->links() }}
    </div>
</x-layouts.admin>
