<x-layouts.admin title="Kelola Aparatur Desa">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Aparatur Desa</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola data perangkat dan aparatur desa</p>
        </div>
        <a href="{{ route('admin.aparatur.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Aparatur
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 text-left border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 font-medium">No</th>
                    <th class="px-4 py-3 font-medium">Foto</th>
                    <th class="px-4 py-3 font-medium">Nama</th>
                    <th class="px-4 py-3 font-medium">Jabatan</th>
                    <th class="px-4 py-3 font-medium text-center">Urutan</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($officials as $official)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 text-slate-500">{{ $officials->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-3">
                            @if ($official->photo)
                                <img src="{{ Storage::url($official->photo) }}"
                                    alt="{{ $official->photo_alt }}"
                                    class="w-10 h-10 rounded-full object-cover border border-slate-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $official->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $official->position }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-full text-xs">{{ $official->display_order }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.aparatur.edit', $official) }}"
                                    class="px-3 py-1.5 text-xs font-medium text-[#192E03] bg-[#192E03]/10 rounded-lg hover:bg-[#192E03]/20 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.aparatur.destroy', $official) }}"
                                    onsubmit="return confirm('Hapus data aparatur ini?');">
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
                        <td colspan="6" class="px-4 py-12 text-center text-slate-500">
                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                            </svg>
                            Belum ada data aparatur.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $officials->links() }}
    </div>
</x-layouts.admin>