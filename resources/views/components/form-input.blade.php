@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'hint' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm
               @error($name) border-red-400 @enderror"
    >
    @if ($hint)
        <p class="text-xs text-slate-500 mt-1">{{ $hint }}</p>
    @endif
    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>