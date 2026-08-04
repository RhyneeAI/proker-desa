@props([
    'umkms' => null,
    'facilities' => null,
    'waterPoints' => null,
    'wisatas' => null,
    'height' => 'h-96 lg:h-[500px]',
    'showToggle' => true,
    'centerLabel' => null,
    'center' => [-6.825112, 107.094836],
    'zoom' => 15,
    'filterSpan' => 0.15,
    'lockMargin' => 0.25,
    'minZoom' => 11,
])

@php
    $umkms = $umkms ?? collect();
    $facilities = $facilities ?? collect();
    $waterPoints = $waterPoints ?? collect();
    $wisatas = $wisatas ?? collect();
    $mapId = 'map-' . \Illuminate\Support\Str::random(10);

    $markers = [
        'umkm' => $umkms->filter(fn ($u) => $u->latitude && $u->longitude)->map(fn ($u) => [
            'name' => $u->name,
            'lat' => (float) $u->latitude,
            'lng' => (float) $u->longitude,
            'category' => $u->category,
            'address' => $u->address,
            'url' => route('umkm.show', $u->id),
        ])->values(),
        'fasilitas' => $facilities->filter(fn ($f) => $f->latitude && $f->longitude)->map(fn ($f) => [
            'name' => $f->name,
            'lat' => (float) $f->latitude,
            'lng' => (float) $f->longitude,
            'address' => $f->address,
        ])->values(),
        'wisata' => $wisatas->filter(fn ($w) => $w->latitude && $w->longitude)->map(fn ($w) => [
            'name' => $w->name,
            'lat' => (float) $w->latitude,
            'lng' => (float) $w->longitude,
            'category' => $w->category,
            'address' => $w->address,
            'url' => route('wisata.show', $w->id),
        ])->values(),
        'titikAir' => $waterPoints->filter(fn ($wp) => $wp->recommend_latitude && $wp->recommend_longitude)->map(fn ($wp) => [
            'name' => $wp->name,
            'lat' => (float) $wp->recommend_latitude,
            'lng' => (float) $wp->recommend_longitude,
            'start_lat' => $wp->start_latitude ? (float) $wp->start_latitude : null,
            'start_lng' => $wp->start_longitude ? (float) $wp->start_longitude : null,
            'end_lat' => $wp->end_latitude ? (float) $wp->end_latitude : null,
            'end_lng' => $wp->end_longitude ? (float) $wp->end_longitude : null,
            'category' => $wp->direction,
            'address' => $wp->address,
            'url' => route('titik-air.show', $wp->slug),
        ])->values(),
    ];

    $config = [
        'markers' => $markers,
        'center' => array_values(is_array($center) ? $center : $center),
        'zoom' => $zoom,
        'centerLabel' => $centerLabel,
        'filterSpan' => $filterSpan,
        'lockMargin' => $lockMargin,
        'minZoom' => $minZoom,
    ];
@endphp

<div class="relative z-0">
    <div id="{{ $mapId }}"
        class="{{ $height }} w-full rounded-2xl border border-slate-200 shadow-sm z-0"
        data-map-config="{{ json_encode($config) }}"></div>

    @if ($showToggle)
        <div class="absolute top-3 right-3 flex flex-col gap-1.5" style="z-index:1100">
            <button type="button" data-map-layer="umkm"
                class="map-layer-btn inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 backdrop-blur-sm border border-slate-200 text-xs font-semibold text-slate-700 shadow-sm hover:shadow transition">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color:#059669"></span>
                UMKM
            </button>
            <button type="button" data-map-layer="fasilitas"
                class="map-layer-btn inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 backdrop-blur-sm border border-slate-200 text-xs font-semibold text-slate-700 shadow-sm hover:shadow transition">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color:#d97706"></span>
                Fasilitas Umum
            </button>
            <button type="button" data-map-layer="wisata"
                class="map-layer-btn inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 backdrop-blur-sm border border-slate-200 text-xs font-semibold text-slate-700 shadow-sm hover:shadow transition">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color:#7c3aed"></span>
                Wisata
            </button>
            <button type="button" data-map-layer="titikAir"
                class="map-layer-btn inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/95 backdrop-blur-sm border border-slate-200 text-xs font-semibold text-slate-700 shadow-sm hover:shadow transition">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color:#2563eb"></span>
                Titik Air
            </button>
        </div>
    @endif
</div>

<script>
(function () {
    var el = document.getElementById('{{ $mapId }}');
    if (!el) return;

    var config = JSON.parse(el.getAttribute('data-map-config'));

    function run() {
        if (window.initInteractiveMap) {
            window.initInteractiveMap(el.id, config);
        } else {
            window.addEventListener('load', run);
        }
    }

    run();
})();
</script>
