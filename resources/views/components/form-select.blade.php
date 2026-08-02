@props(['label', 'name', 'options' => [], 'selected' => '', 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="w-full rounded-lg border-slate-300 focus:border-[#192E03] focus:ring-[#192E03] text-sm
               @error($name) border-red-400 @enderror"
    >
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>