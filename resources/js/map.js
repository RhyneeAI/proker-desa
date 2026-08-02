import { Map, Marker, Popup, NavigationControl, LngLatBounds } from 'maplibre-gl';
import 'maplibre-gl/dist/maplibre-gl.css';

const escapeHtml = (value) =>
    String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[char]));

const pinHtml = (color) =>
    '<svg width="30" height="38" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="' + color + '" stroke="#ffffff" stroke-width="1.5"/>' +
    '<circle cx="15" cy="14" r="5.5" fill="#ffffff"/></svg>';

const centerPinHtml = () =>
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

// Basemap raster andal (Carto Voyager, gaya ala Google Maps, gratis) dengan
// fallback ke tile OpenStreetMap bila tile Carto gagal dimuat.
const rasterStyle = (tiles, attribution) => ({
    version: 8,
    sources: {
        base: { type: 'raster', tiles, tileSize: 256, attribution },
    },
    layers: [{ id: 'base', type: 'raster', source: 'base' }],
});

const CARTO_STYLE = rasterStyle(
    [
        'https://a.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://b.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://c.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        'https://d.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
    ],
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>'
);

const OSM_STYLE = rasterStyle(
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
    const mapBounds = [
        [centerLng - lockMargin, centerLat - lockMargin],
        [centerLng + lockMargin, centerLat + lockMargin],
    ];

    const map = new Map({
        container: mapId,
        style: CARTO_STYLE,
        center: [centerLng, centerLat],
        zoom,
        minZoom,
        maxBounds: mapBounds,
        scrollZoom: false,
    });

    map.addControl(new NavigationControl({ showCompass: false }), 'top-right');

    let tileErrors = 0;
    let fellBack = false;
    map.on('error', (e) => {
        if (fellBack) return;
        if (e.error?.message?.startsWith('Style')) {
            fellBack = true;
            map.setStyle(OSM_STYLE);
            return;
        }
        tileErrors += 1;
        if (tileErrors > 8) {
            fellBack = true;
            map.setStyle(OSM_STYLE);
        }
    });

    map.on('load', () => {
        fetch(VILLAGE_BOUNDARY_URL)
            .then((r) => r.json())
            .then((data) => {
                if (!map.getSource('village-boundary')) {
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
                }
            })
            .catch(() => {});
    });

    const colors = { umkm: '#059669', fasilitas: '#d97706', wisata: '#7c3aed', titikAir: '#2563eb' };
    const groups = { umkm: [], fasilitas: [], wisata: [], titikAir: [] };
    const coords = [];

    Object.keys(groups).forEach((layer) => {
        (markers[layer] || []).forEach((marker) => {
            if (!inVillageArea(marker.lat, marker.lng, center, filterSpan)) return;

            const pinEl = document.createElement('div');
            pinEl.innerHTML = pinHtml(colors[layer]);

            const mk = new Marker({ element: pinEl.firstChild, anchor: 'bottom' })
                .setLngLat([marker.lng, marker.lat])
                .setPopup(new Popup({ offset: 30 }).setHTML(popupHtml(marker)))
                .addTo(map);

            groups[layer].push(mk);
            coords.push([marker.lng, marker.lat]);
        });
    });

    if (centerLabel) {
        const centerEl = document.createElement('div');
        centerEl.innerHTML = centerPinHtml();

        new Marker({ element: centerEl.firstChild, anchor: 'bottom' })
            .setLngLat([centerLng, centerLat])
            .setPopup(
                new Popup({ offset: 35 }).setHTML(
                    '<div style="text-align:center;min-width:150px"><p style="font-weight:700;color:#0f172a;font-size:13px;margin:0">' +
                        escapeHtml(centerLabel) +
                        '</p><p style="color:#64748b;font-size:11px;margin:4px 0 0">Pusat Desa</p></div>'
                )
            )
            .addTo(map);
    }

    if (coords.length) {
        const bounds = coords.reduce(
            (b, [lng, lat]) => b.extend([lng, lat]),
            new LngLatBounds(coords[0], coords[0])
        );
        const { lat: south, lng: west } = bounds.getSouthWest();
        const { lat: north, lng: east } = bounds.getNorthEast();

        if (north - south < 0.05 && east - west < 0.05) {
            map.fitBounds(bounds, { padding: 50, maxZoom: 16 });
        }
    }

    el.parentElement.querySelectorAll('[data-map-layer]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const layer = btn.getAttribute('data-map-layer');
            const current = groups[layer] || [];
            const visible = current.some((m) => m.getElement().style.display !== 'none');
            const show = !visible;

            current.forEach((m) => {
                m.getElement().style.display = show ? '' : 'none';
            });
            btn.classList.toggle('opacity-50', !show);
        });
    });

    el.dataset.mapInitialized = '1';
}
