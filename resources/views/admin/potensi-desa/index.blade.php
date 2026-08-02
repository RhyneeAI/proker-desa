<x-layouts.admin title="Kelola Potensi Desa">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Potensi Desa</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola potensi dan kekayaan desa</p>
        </div>
        <a href="{{ route('admin.potensi-desa.create') }}"
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Potensi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($potensiDesa as $item)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($item->image)
                                    <img src="{{ Storage::url($item->image) }}"
                                        alt="{{ $item->image_alt ?? $item->name }}"
                                        class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15l4-8 4 8m-7 3h14"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-medium text-slate-800">{{ $item->name }}</p>
                                    @if ($item->description)
                                        <p class="text-xs text-slate-500 truncate max-w-xs">{{ $item->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-[#192E03]/10 text-[#192E03] capitalize">
                                {{ $item->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('admin.potensi-desa.edit', $item) }}"
                                    class="text-xs text-[#192E03] hover:underline font-medium">Edit</a>
                                <form method="POST" action="{{ route('admin.potensi-desa.destroy', $item) }}"
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
                        <td colspan="3" class="px-6 py-16 text-center text-slate-500">
                            Belum ada potensi desa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $potensiDesa->links() }}
    </div>
</x-layouts.admin>
