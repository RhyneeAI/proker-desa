@props(['official'])

<div class="w-full bg-white rounded-2xl border border-slate-200 shadow-sm p-5 text-center hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
    @if ($official->photo)
        <img src="{{ Storage::url($official->photo) }}"
            alt="{{ $official->photo_alt ?? $official->name }}"
            class="w-16 h-16 rounded-full object-cover mx-auto ring-4 ring-[#192E03]/10">
    @else
        <div class="w-16 h-16 rounded-full bg-[#192E03]/10 ring-4 ring-[#192E03]/10 mx-auto flex items-center justify-center">
            <svg class="w-7 h-7 text-[#192E03]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
    @endif
    <h3 class="font-semibold text-[#192E03] mt-3 text-sm leading-snug">{{ $official->name }}</h3>
    <p class="text-[11px] text-[#192E03]/70 font-semibold mt-1 uppercase tracking-wide">{{ $official->position }}</p>
</div>
