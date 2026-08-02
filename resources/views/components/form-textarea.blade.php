@props(['label', 'name', 'value' => '', 'rows' => 4, 'placeholder' => '', 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm
               @error($name) border-red-400 @enderror"
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>