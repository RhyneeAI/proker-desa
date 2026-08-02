<x-layouts.admin title="Kelola UMKM">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="page-title mb-1">UMKM</h2>
            <p class="text-secondary mb-0">Kelola data usaha mikro kecil menengah desa</p>
        </div>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-1"></i> Tambah UMKM
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Usaha</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th>Koordinat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkms as $umkm)
                        <tr>
                            <td>
                                @if ($umkm->photo)
                                    <img src="{{ Storage::url($umkm->photo) }}"
                                        alt="{{ $umkm->photo_alt }}"
                                        class="avatar avatar-lg rounded">
                                @else
                                    <span class="avatar avatar-lg bg-secondary-lt rounded">
                                        <i class="ti ti-building-store text-secondary"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <p class="fw-medium text-body mb-0">{{ $umkm->name }}</p>
                            </td>
                            <td class="text-secondary">{{ $umkm->owner_name }}</td>
                            <td>
                                @if ($umkm->category)
                                    <span class="badge bg-secondary">{{ $umkm->category }}</span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($umkm->latitude && $umkm->longitude)
                                    <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                                        target="_blank"
                                        class="text-primary">
                                        Lihat Peta
                                    </a>
                                @else
                                    <span class="text-secondary">Belum diisi</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.umkm.edit', $umkm) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.umkm.destroy', $umkm) }}"
                                        onsubmit="return confirm('Hapus data UMKM ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-5">
                                <i class="ti ti-inbox text-secondary mb-2" style="font-size:2rem"></i>
                                <div>Belum ada data UMKM.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $umkms->links() }}
    </div>
</x-layouts.admin>
