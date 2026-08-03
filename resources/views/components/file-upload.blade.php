@props([
    'name' => '',
    'label' => '',
    'multiple' => false,
    'accept' => 'image/*',
    'hint' => '',
    'required' => false,
    'previews' => [],
])

<div class="mb-3" x-data="fileUpload(@js($previews), {{ $multiple ? 'true' : 'false' }})">
    <label class="form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <div @dragover.prevent="dragover = true" @dragleave.prevent="dragover = false"
        @drop.prevent="handleDrop($event)"
        class="border-2 border-dashed rounded p-4 text-center cursor-pointer transition"
        :class="dragover ? 'border-primary bg-primary-lt' : 'border-secondary-subtle bg-body-secondary bg-opacity-25'">
        <input type="file"
            name="{{ $name }}"
            accept="{{ $accept }}"
            {{ $multiple ? 'multiple' : '' }}
            {{ $required ? 'required' : '' }}
            class="d-none"
            x-ref="input"
            @change="handleInput()">
        <i class="ti ti-upload text-secondary" style="font-size:2rem"></i>
        <p class="mb-1 text-secondary">{{ $multiple ? 'Klik atau seret beberapa file ke sini' : 'Klik atau seret file ke sini' }}</p>
        @if ($hint)
            <small class="text-secondary">{{ $hint }}</small>
        @endif
    </div>

    <div class="mt-2 d-flex flex-wrap gap-2" x-show="previews.length">
        <template x-for="(p, i) in previews" :key="i">
            <div class="position-relative">
                <img :src="p" class="rounded border" style="width:72px;height:72px;object-fit:cover">
                <button type="button" class="btn btn-sm btn-icon btn-danger position-absolute top-0 end-0"
                    style="transform:translate(30%,-30%)" @click="remove(i)" title="Hapus">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        </template>
    </div>

    <small x-show="error" class="text-danger d-block mt-1" x-text="error"></small>
</div>
