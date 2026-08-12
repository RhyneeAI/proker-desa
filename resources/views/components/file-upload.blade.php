@props([
    'name' => '',
    'label' => '',
    'multiple' => false,
    'accept' => 'image/*',
    'hint' => '',
    'required' => false,
    'previews' => [],
    'maxSize' => 5,
])

<div class="mb-3" x-data="fileUploadGuard({{ $multiple ? 'true' : 'false' }}, {{ $maxSize * 1024 * 1024 }})">
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    @if (!empty($previews))
        <div class="d-flex flex-wrap gap-2 mb-2">
            @foreach ($previews as $preview)
                <img src="{{ $preview }}"
                    class="rounded border" style="width:72px;height:72px;object-fit:cover"
                    alt="{{ $label }}">
            @endforeach
        </div>
        @if (!$multiple)
            <p class="small text-secondary mb-2">Foto di atas adalah gambar yang sedang tersimpan. Pilih file baru di bawah untuk menggantinya.</p>
        @else
            <p class="small text-secondary mb-2">Foto di atas adalah gambar yang sedang tersimpan. Pilih file baru di bawah untuk menambahkannya.</p>
        @endif
    @endif

    <input type="file"
        name="{{ $name }}"
        accept="{{ $accept }}"
        x-ref="input"
        @change="onChange"
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        class="form-control @error($name) is-invalid @enderror">

    <template x-if="selected">
        <small class="d-block mt-1 text-secondary" x-text="selected"></small>
    </template>

    <div x-show="error" class="text-danger small mt-1" x-text="error"></div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <small class="text-secondary d-block mt-1">Maks. {{ $maxSize }}MB per file.</small>

    @if ($hint)
        <small class="text-secondary">{{ $hint }}</small>
    @endif
</div>
