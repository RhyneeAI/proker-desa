<x-layouts.admin title="Kelola UMKM">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">UMKM</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola data usaha mikro kecil menengah desa</p>
        </div>
        <a href="{{ route('admin.umkm.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah UMKM
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 text-left border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Foto</th>
                    <th class="px-4 py-3 font-medium">Nama Usaha</th>
                    <th class="px-4 py-3 font-medium">Pemilik</th>
                    <th class="px-4 py-3 font-medium">Kategori</th>
                    <th class="px-4 py-3 font-medium">Koordinat</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($umkms as $umkm)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            @if ($umkm->photo)
                                <img src="{{ Storage::url($umkm->photo) }}"
                                    alt="{{ $umkm->photo_alt }}"
                                    class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $umkm->name }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $umkm->owner_name }}</td>
                        <td class="px-4 py-3">
                            @if ($umkm->category)
                                <span class="px-2 py-1 text-xs bg-slate-100 text-slate-600 rounded-full">{{ $umkm->category }}</span>
                            @else
                                <span class="text-slate-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500">
                            @if ($umkm->latitude && $umkm->longitude)
                                <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                                    target="_blank"
                                    class="text-[#192E03] hover:underline">
                                    Lihat Peta
                                </a>
                            @else
                                <span class="text-slate-400">Belum diisi</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.umkm.edit', $umkm) }}"
                                    class="px-3 py-1.5 text-xs font-medium text-[#192E03] bg-[#192E03]/10 rounded-lg hover:bg-[#192E03]/20 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.umkm.destroy', $umkm) }}"
                                    onsubmit="return confirm('Hapus data UMKM ini?');">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            Belum ada data UMKM.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $umkms->links() }}
    </div>
</x-layouts.admin>