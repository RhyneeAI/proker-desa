@props(['title' => 'Legenda'])

@php
    $pin = fn (string $color, string $glyph) => '<svg width="22" height="28" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg" class="inline-block align-middle">' .
        '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="' . $color . '" stroke="#ffffff" stroke-width="1.5"/>' .
        '<circle cx="15" cy="14" r="7" fill="#ffffff"/>' . $glyph . '</svg>';

    $umkm = '<path d="M8.5 16h13l-.6 5.5h-11.8L8.5 16z" fill="none" stroke="#059669" stroke-width="1.6" stroke-linejoin="round"/>' .
        '<path d="M11.5 21.5v-4h7v4" fill="none" stroke="#059669" stroke-width="1.6" stroke-linejoin="round"/>' .
        '<path d="M6.5 16L15 10l8.5 6" fill="none" stroke="#059669" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>';

    $fasilitas = '<path d="M8.5 22v-8.5l6.5-5 6.5 5V22" fill="none" stroke="#d97706" stroke-width="1.6" stroke-linejoin="round"/>' .
        '<path d="M7 22h16" stroke="#d97706" stroke-width="1.6" stroke-linecap="round"/>' .
        '<path d="M12.5 22v-4h5v4" fill="none" stroke="#d97706" stroke-width="1.6" stroke-linejoin="round"/>';

    $titikAir = '<path d="M15 6.5c3.2 3.4 5 6.1 5 8.6a5 5 0 01-10 0c0-2.5 1.8-5.2 5-8.6z" fill="#2563eb" stroke="#ffffff" stroke-width="0.6"/>';
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center justify-center gap-x-7 gap-y-2']) }}>
    <span class="text-xs font-bold uppercase tracking-widest text-slate-500">{{ $title }}</span>
    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600">{!! $pin('#059669', $umkm) !!} UMKM</span>
    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600">{!! $pin('#d97706', $fasilitas) !!} Fasilitas Umum</span>
    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600">{!! $pin('#2563eb', $titikAir) !!} Titik Air</span>
</div>
