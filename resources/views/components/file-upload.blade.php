@props([
    'name' => '',
    'label' => '',
    'multiple' => false,
    'accept' => 'image/*',
    'hint' => '',
    'required' => false,
    'previews' => [],
])

<div class="mb-3">
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
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        class="form-control">

    @if ($hint)
        <small class="text-secondary">{{ $hint }}</small>
    @endif
</div>
