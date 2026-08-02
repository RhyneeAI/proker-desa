<x-layouts.admin title="Kelola Fasilitas Umum">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-semibold text-[#192E03]">Fasilitas Umum</h2>
            <p class="text-sm text-slate-500 mt-0.5">Kelola data fasilitas umum desa</p>
        </div>
        <a href="{{ route('admin.fasilitas.create') }}"
            class="px-4 py-2 bg-[#192E03] text-white text-sm font-medium rounded-lg hover:bg-[#1F3B04] transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Fasilitas
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 text-left border-b border-slate-200">
                <tr>
                    <th class="px-4 py-3 font-medium">Foto</th>
                    <th class="px-4 py-3 font-medium">Nama Fasilitas</th>
                    <th class="px-4 py-3 font-medium">Alamat</th>
                    <th class="px-4 py-3 font-medium">Koordinat</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($facilities as $facility)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            @if ($facility->photo)
                                <img src="{{ Storage::url($facility->photo) }}"
                                    alt="{{ $facility->photo_alt }}"
                                    class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $facility->name }}</td>
                        <td class="px-4 py-3 text-slate-600 text-xs max-w-48 truncate">{{ $facility->address ?? '-' }}</td>
                        <td class="px-4 py-3 text-xs">
                            @if ($facility->latitude && $facility->longitude)
                                <a href="https://www.google.com/maps?q={{ $facility->latitude }},{{ $facility->longitude }}"
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
                                <a href="{{ route('admin.fasilitas.edit', $facility) }}"
                                    class="px-3 py-1.5 text-xs font-medium text-[#192E03] bg-[#192E03]/10 rounded-lg hover:bg-[#192E03]/20 transition">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.fasilitas.destroy', $facility) }}"
                                    onsubmit="return confirm('Hapus fasilitas ini?');">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Belum ada data fasilitas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $facilities->links() }}
    </div>
</x-layouts.admin>