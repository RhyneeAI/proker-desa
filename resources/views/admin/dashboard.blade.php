<x-layouts.admin title="Dashboard">

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        @foreach ([
            'Berita'        => $stats['news'],
            'Pengumuman'    => $stats['announcements'],
            'Aparatur'      => $stats['officials'],
            'UMKM'          => $stats['umkms'],
            'Fasilitas'     => $stats['facilities'],
            'Foto Galeri'   => $stats['galleries'],
        ] as $label => $value)
            <div class="bg-white rounded-xl border border-slate-200 p-4 text-center">
                <p class="text-2xl font-bold text-[#192E03]">{{ $value }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    {{-- Tabel --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Berita Terbaru --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-[#192E03] text-sm">Berita Terbaru</h2>
                <a href="{{ route('admin.berita.index') }}" class="text-xs text-[#192E03] hover:underline">Lihat Semua</a>
            </div>

            @forelse ($latestNews as $news)
                <div class="py-2.5 border-b border-slate-100 last:border-0 flex justify-between items-start gap-3">
                    <div class="min-w-0">
                        <p class="text-sm text-slate-800 truncate">{{ $news->title }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $news->published_at?->translatedFormat('d F Y') }}</p>
                    </div>
                    <span class="flex-shrink-0 px-2 py-0.5 text-xs rounded-full {{ $news->is_published ? 'bg-[#192E03]/20 text-[#192E03]' : 'bg-slate-100 text-slate-500' }}">
                        {{ $news->is_published ? 'Terbit' : 'Draf' }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-slate-500 text-center py-4">Belum ada berita.</p>
            @endforelse
        </div>

        {{-- Pengumuman Terbaru --}}
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-[#192E03] text-sm">Pengumuman Terbaru</h2>
                <a href="{{ route('admin.pengumuman.index') }}" class="text-xs text-[#192E03] hover:underline">Lihat Semua</a>
            </div>

            @forelse ($latestAnnouncements as $announcement)
                <div class="py-2.5 border-b border-slate-100 last:border-0">
                    <p class="text-sm text-slate-800 truncate">{{ $announcement->title }}</p>
                    <div class="flex items-center gap-3 mt-0.5">
                        <p class="text-xs text-slate-500">{{ $announcement->published_at?->translatedFormat('d F Y') }}</p>
                        @if ($announcement->deadline)
                            <span class="text-xs {{ $announcement->deadline->isPast() ? 'text-red-500' : 'text-amber-600' }}">
                                Tenggat {{ $announcement->deadline->translatedFormat('d F Y') }}
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500 text-center py-4">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>

    {{-- Shortcut --}}
    <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-3">
        <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 hover:border-[#192E03]/50 hover:text-[#192E03] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Berita
        </a>
        <a href="{{ route('admin.pengumuman.create') }}" class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 hover:border-[#192E03]/50 hover:text-[#192E03] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengumuman
        </a>
        <a href="{{ route('admin.galeri.create') }}" class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 hover:border-[#192E03]/50 hover:text-[#192E03] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Upload Foto
        </a>
        <a href="{{ route('admin.umkm.create') }}" class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 hover:border-[#192E03]/50 hover:text-[#192E03] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah UMKM
        </a>
    </div>
</x-layouts.admin>