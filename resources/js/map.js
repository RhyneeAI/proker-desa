import { Map, Popup, NavigationControl, LngLatBounds, setWorkerUrl } from 'maplibre-gl';
import 'maplibre-gl/dist/maplibre-gl.css';
import maplibreWorkerUrl from 'maplibre-gl/dist/maplibre-gl-worker.mjs?url';

// Vite tidak bisa membundel worker MapLibre secara otomatis (dynamic `new Worker(...)`),
// jadi URL worker di-resolve manual lalu didaftarkan di sini.
setWorkerUrl(maplibreWorkerUrl);

const escapeHtml = (value) =>
    String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[char]));

const pinSvg = (color) =>
    '<svg width="30" height="38" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="' + color + '" stroke="#ffffff" stroke-width="1.5"/>' +
    '<circle cx="15" cy="14" r="5.5" fill="#ffffff"/></svg>';

const centerSvg = () =>
    '<svg width="38" height="46" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="#192E03" stroke="#ffffff" stroke-width="2"/>' +
    '<path d="M6 14h18M15 5v18M9 11h12M9 17h12" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" transform="translate(0 -2)"/>' +
    '</svg>';

const popupHtml = (marker) => {
    let html = '<div class="text-center" style="min-width:140px">';
    html += '<p style="font-weight:700;color:#0f172a;font-size:13px;margin:0">' + escapeHtml(marker.name) + '</p>';

    const sub = [];
    if (marker.category) sub.push(marker.category);
    if (marker.address) sub.push(marker.address);
    if (sub.length) {
        html += '<p style="color:#64748b;font-size:11px;margin:4px 0 0;line-height:1.4">' + sub.map(escapeHtml).join(' &bull; ') + '</p>';
    }

    if (marker.url) {
        html += '<a href="' + escapeHtml(marker.url) + '" style="display:inline-block;margin-top:8px;font-size:11px;font-weight:600;color:#ffffff;background:#192E03;padding:5px 12px;border-radius:9999px;text-decoration:none">Lihat Detail</a>';
    }

    return html + '</div>';
};

const inVillageArea = (lat, lng, center, filterSpan) =>
    Math.abs(lat - center[0]) <= filterSpan && Math.abs(lng - center[1]) <= filterSpan;

const svgDataUrl = (svg) => 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svg);

// Basemap: OpenFreeMap vector sebagai utama (lebih tajam & scalable),
// dengan rantai fallback ke raster bila vector gagal dimuat (lihat STYLE_CHAIN).
const OPENFREEMAP_STYLE = 'https://tiles.openfreemap.org/styles/liberty';

const rasterStyle = (tiles, attribution) => ({
    version: 8,
    sources: {
        base: { type: 'raster', tiles, tileSize: 256, attribution },
    },
    layers: [{ id: 'base', type: 'raster', source: 'base' }],
});

const CARTO_RASTER = rasterStyle(
    [
        'https://a.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://b.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://c.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://d.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
    ],
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
);

const OSM_RASTER = rasterStyle(
    [
        'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'https://b.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'https://c.tile.openstreetmap.org/{z}/{x}/{y}.png',
    ],
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
);

const VILLAGE_BOUNDARY_URL = '/js/village-boundary.geojson';

export function initInteractiveMap(mapId, config) {
    const el = document.getElementById(mapId);

    if (!el || el.dataset.mapInitialized) return;

    const {
        markers = { umkm: [], fasilitas: [], wisata: [], titikAir: [] },
        center = [-6.825112, 107.094836],
        zoom = 15,
        centerLabel = null,
        filterSpan = 0.15,
        lockMargin = 0.25,
        minZoom = 11,
    } = config;

    const [centerLat, centerLng] = center;
    const colors = { umkm: '#059669', fasilitas: '#d97706', wisata: '#7c3aed', titikAir: '#2563eb' };

    const map = new Map({
        container: mapId,
        style: OPENFREEMAP_STYLE,
        center: [centerLng, centerLat],
        zoom,
        minZoom,
        maxBounds: [
            [centerLng - lockMargin, centerLat - lockMargin],
            [centerLng + lockMargin, centerLat + lockMargin],
        ],
        scrollZoom: false,
    });

    map.addControl(new NavigationControl({ showCompass: false }), 'top-right');

    // Rantai fallback: OpenFreeMap vector -> Carto raster -> OSM raster
    const STYLE_CHAIN = [OPENFREEMAP_STYLE, CARTO_RASTER, OSM_RASTER];
    let styleIdx = 0;
    let tileErrors = 0;
    let styleSwapped = false;

    const nextStyle = () => {
        styleIdx += 1;
        if (styleIdx >= STYLE_CHAIN.length) return;
        styleSwapped = true;
        tileErrors = 0;
        map.setStyle(STYLE_CHAIN[styleIdx]);
    };

    map.on('error', (e) => {
        if (styleIdx >= STYLE_CHAIN.length) return;
        if (e.error?.message?.startsWith('Style')) {
            nextStyle();
            return;
        }
        tileErrors += 1;
        if (tileErrors > 3) {
            nextStyle();
        }
    });

    // Watchdog: bila style tidak kunjung idle (tile gagal dimuat), paksa fallback.
    setTimeout(() => {
        if (styleIdx < STYLE_CHAIN.length && !map.loaded() && !styleSwapped) {
            nextStyle();
        }
    }, 6000);

    const addPinImage = (id, svg) =>
        new Promise((resolve) => {
            const img = new Image();
            img.onload = () => {
                try {
                    if (!map.hasImage(id)) map.addImage(id, img, { pixelRatio: 1 });
                } catch (e) {
                    /* image sudah ada / gagal */
                }
                resolve();
            };
            img.onerror = () => resolve();
            img.src = svgDataUrl(svg);
        });

    const setupLayers = async () => {
        try {
            // Ikon pin sebagai image map (harus HTMLImageElement di MapLibre v6)
            await Promise.all([
                addPinImage('pin-umkm', pinSvg(colors.umkm)),
                addPinImage('pin-fasilitas', pinSvg(colors.fasilitas)),
                addPinImage('pin-wisata', pinSvg(colors.wisata)),
                addPinImage('pin-titikAir', pinSvg(colors.titikAir)),
                ...(centerLabel ? [addPinImage('pin-center', centerSvg())] : []),
            ]);

        // Batas desa (poligon)
        if (!map.getSource('village-boundary')) {
            fetch(VILLAGE_BOUNDARY_URL)
                .then((r) => r.json())
                .then((data) => {
                    if (map.getSource('village-boundary')) return;
                    map.addSource('village-boundary', { type: 'geojson', data });
                    map.addLayer({
                        id: 'village-boundary-fill',
                        type: 'fill',
                        source: 'village-boundary',
                        paint: { 'fill-color': '#192E03', 'fill-opacity': 0.12 },
                    });
                    map.addLayer({
                        id: 'village-boundary-line',
                        type: 'line',
                        source: 'village-boundary',
                        paint: { 'line-color': '#192E03', 'line-width': 2.5, 'line-dasharray': [2, 1.5] },
                    });
                })
                .catch(() => {});
        }

        const allCoords = [];

        // Trajectory titik air (garis Titik Awal -> Titik Akhir)
        const lineFeats = (markers.titikAir || [])
            .filter((m) => m.start_lat && m.start_lng && m.end_lat && m.end_lng)
            .filter((m) => inVillageArea(m.start_lat, m.start_lng, center, filterSpan) || inVillageArea(m.recommend_lat, m.recommend_lng, center, filterSpan))
            .map((m) => ({
                type: 'Feature',
                geometry: { type: 'LineString', coordinates: [[m.start_lng, m.start_lat], [m.end_lng, m.end_lat]] },
                properties: {},
            }));

        if (lineFeats.length && !map.getSource('src-trajectory')) {
            map.addSource('src-trajectory', { type: 'geojson', data: { type: 'FeatureCollection', features: lineFeats } });
            map.addLayer({
                id: 'layer-trajectory',
                type: 'line',
                source: 'src-trajectory',
                paint: { 'line-color': '#2563eb', 'line-width': 2, 'line-dasharray': [3, 2], 'line-opacity': 0.7 },
            });
        }

        // Layer titik per kelompok (GeoJSON Point -> symbol)
        Object.keys(colors).forEach((layer) => {
            const feats = (markers[layer] || [])
                .filter((m) => inVillageArea(m.lat, m.lng, center, filterSpan))
                .map((m) => {
                    allCoords.push([m.lng, m.lat]);
                    return {
                        type: 'Feature',
                        geometry: { type: 'Point', coordinates: [m.lng, m.lat] },
                        properties: { name: m.name, category: m.category, address: m.address, url: m.url },
                    };
                });

            if (!feats.length || map.getSource('src-' + layer)) return;

            map.addSource('src-' + layer, { type: 'geojson', data: { type: 'FeatureCollection', features: feats } });
            map.addLayer({
                id: 'layer-' + layer,
                type: 'symbol',
                source: 'src-' + layer,
                layout: {
                    'icon-image': 'pin-' + layer,
                    'icon-anchor': 'bottom',
                    'icon-allow-overlap': true,
                    'icon-size': 1,
                },
            });

            map.on('click', 'layer-' + layer, (e) => {
                map.getCanvas().style.cursor = '';
                const f = e.features[0];
                new Popup({ offset: 30 }).setLngLat(e.lngLat).setHTML(popupHtml(f.properties)).addTo(map);
            });
            map.on('mouseenter', 'layer-' + layer, () => (map.getCanvas().style.cursor = 'pointer'));
            map.on('mouseleave', 'layer-' + layer, () => (map.getCanvas().style.cursor = ''));
        });

        // Pin pusat desa
        if (centerLabel && !map.getSource('src-center')) {
            map.addSource('src-center', {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [{ type: 'Feature', geometry: { type: 'Point', coordinates: [centerLng, centerLat] }, properties: {} }],
                },
            });
            map.addLayer({
                id: 'layer-center',
                type: 'symbol',
                source: 'src-center',
                layout: { 'icon-image': 'pin-center', 'icon-anchor': 'bottom', 'icon-size': 1 },
            });
            map.on('click', 'layer-center', () =>
                new Popup({ offset: 35 }).setLngLat([centerLng, centerLat]).setHTML(
                    '<div style="text-align:center;min-width:150px"><p style="font-weight:700;color:#0f172a;font-size:13px;margin:0">' +
                        escapeHtml(centerLabel) +
                        '</p><p style="color:#64748b;font-size:11px;margin:4px 0 0">Pusat Desa</p></div>'
                ).addTo(map)
            );
        }

        // Fit bounds bila titik mengumpul
        if (allCoords.length) {
            const bounds = allCoords.reduce((b, c) => b.extend(c), new LngLatBounds(allCoords[0], allCoords[0]));
            const { lat: south, lng: west } = bounds.getSouthWest();
            const { lat: north, lng: east } = bounds.getNorthEast();

            if (north - south < 0.05 && east - west < 0.05) {
                map.fitBounds(bounds, { padding: 50, maxZoom: 16 });
            }
        }
        } catch (e) {
            console.error('Map setup error:', e);
        }
    };

    map.on('load', setupLayers);
    map.on('style.load', () => {
        if (styleSwapped) setupLayers();
    });

    // Toggle layer
    el.parentElement.querySelectorAll('[data-map-layer]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const layer = btn.getAttribute('data-map-layer');
            const layerId = 'layer-' + layer;
            if (!map.getLayer(layerId)) return;

            const current = map.getLayoutProperty(layerId, 'visibility') || 'visible';
            const show = current === 'none';
            map.setLayoutProperty(layerId, 'visibility', show ? 'visible' : 'none');
            btn.classList.toggle('opacity-50', !show);
        });
    });

    el.dataset.mapInitialized = '1';
}
