<x-layouts.admin title="Edit Pengumuman">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.pengumuman.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.pengumuman.update', $announcement) }}">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Konten Pengumuman</h3>
                </div>
                <div class="card-body">
                    <x-form-input
                        label="Judul Pengumuman"
                        name="title"
                        :value="$announcement->title"
                        required
                    />

                    <x-form-textarea
                        label="Isi Pengumuman"
                        name="content"
                        :value="$announcement->content"
                        :rows="8"
                        required
                    />

                    <x-form-input
                        label="Tenggat Waktu (opsional)"
                        name="deadline"
                        type="date"
                        :value="$announcement->deadline?->format('Y-m-d')"
                        hint="Kosongkan jika pengumuman tidak memiliki batas waktu berlaku."
                    />
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Status Publikasi</h3>
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_published" value="1"
                            {{ old('is_published', $announcement->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label">
                            <span class="d-block fw-medium">Diterbitkan</span>
                            <small class="text-secondary d-block">
                                @if ($announcement->published_at)
                                    Terbit sejak {{ $announcement->published_at->translatedFormat('d F Y, H:i') }}
                                @else
                                    Belum pernah diterbitkan
                                @endif
                            </small>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
