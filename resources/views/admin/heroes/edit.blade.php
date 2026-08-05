<x-layouts.admin title="Edit Slide Hero">
    <div class="col-12 col-xl-8 mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.hero.index') }}" class="link-secondary text-decoration-none">
                <i class="ti ti-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.hero.update', $heroSlide) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Detail Slide</h3>
                </div>
                <div class="card-body">
                    <x-form-input label="Judul (opsional)" name="title" :value="$heroSlide->title" />
                    <x-form-input label="Subjudul (opsional)" name="subtitle" :value="$heroSlide->subtitle" />

                    <x-file-upload
                        name="image"
                        label="Ganti Gambar Background"
                        hint="Kosongkan untuk tetap memakai gambar saat ini atau gambar acak otomatis."
                        :previews="$heroSlide->image ? [Storage::url($heroSlide->image)] : []"
                    />

                    <x-form-input label="Teks Alternatif" name="image_alt" :value="$heroSlide->image_alt" />

                    <x-form-input
                        label="Urutan"
                        name="sort_order"
                        type="number"
                        :value="$heroSlide->sort_order"
                        hint="Semakin kecil, semakin awal tampil."
                    />

                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="active" value="1" {{ $heroSlide->active ? 'checked' : '' }}>
                            <span class="form-check-label">Tampilkan slide ini di beranda</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.hero.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
