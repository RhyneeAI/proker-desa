const escapeHtml = (value) =>
    String(value ?? '').replace(/[&<>"']/g, (char) => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
    }[char]));

const pinHtml = (color) =>
    '<div><svg width="30" height="38" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="' + color + '" stroke="#ffffff" stroke-width="1.5"/>' +
    '<circle cx="15" cy="14" r="5.5" fill="#ffffff"/></svg></div>';

const centerPinHtml = () =>
    '<div><svg width="38" height="46" viewBox="0 0 30 38" xmlns="http://www.w3.org/2000/svg">' +
    '<path d="M15 1C7.82 1 2 6.82 2 14c0 9.75 13 23 13 23s13-13.25 13-23C28 6.82 22.18 1 15 1z" fill="#192E03" stroke="#ffffff" stroke-width="2"/>' +
    '<path d="M6 14h18M15 5v18M9 11h12M9 17h12" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" transform="translate(0 -2)"/>' +
    '</svg></div>';

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

export function initInteractiveMap(mapId, config) {
    const L = window.L;
    const el = document.getElementById(mapId);

    if (!L || !el || el._leaflet_id) return;

    const {
        markers = { umkm: [], fasilitas: [] },
        center = [-6.8228, 107.1003],
        zoom = 15,
        centerLabel = null,
        filterSpan = 0.15,
        lockMargin = 0.25,
        minZoom = 11,
    } = config;

    const map = L.map(mapId, { scrollWheelZoom: false });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    const colors = { umkm: '#059669', fasilitas: '#d97706' };
    const groups = { umkm: L.layerGroup(), fasilitas: L.layerGroup() };
    const bounds = L.latLngBounds();

    Object.keys(groups).forEach((layer) => {
        (markers[layer] || []).forEach((marker) => {
            if (!inVillageArea(marker.lat, marker.lng, center, filterSpan)) return;

            const mk = L.marker([marker.lat, marker.lng], {
                icon: L.divIcon({
                    className: '',
                    html: pinHtml(colors[layer]),
                    iconSize: [30, 38],
                    iconAnchor: [15, 37],
                    popupAnchor: [0, -34],
                }),
            }).bindPopup(popupHtml(marker));

            mk.addTo(groups[layer]);
            bounds.extend([marker.lat, marker.lng]);
        });

        groups[layer].addTo(map);
    });

    if (centerLabel) {
        L.marker(center, {
            icon: L.divIcon({
                className: '',
                html: centerPinHtml(),
                iconSize: [38, 46],
                iconAnchor: [19, 45],
                popupAnchor: [0, -42],
            }),
            zIndexOffset: 1000,
        }).bindPopup(
            '<div style="text-align:center;min-width:150px"><p style="font-weight:700;color:#0f172a;font-size:13px;margin:0">' +
                escapeHtml(centerLabel) +
                '</p><p style="color:#64748b;font-size:11px;margin:4px 0 0">Pusat Desa</p></div>'
        ).addTo(map);
    }

    if (bounds.isValid()) {
        const spanLat = bounds.getNorthEast().lat - bounds.getSouthWest().lat;
        const spanLng = bounds.getNorthEast().lng - bounds.getSouthWest().lng;

        if (spanLat < 0.05 && spanLng < 0.05) {
            map.fitBounds(bounds, { padding: [40, 40], maxZoom: 16 });
        } else {
            map.setView(center, zoom);
        }
    } else {
        map.setView(center, zoom);
    }

    map.setMinZoom(minZoom);
    map.setMaxBounds(
        L.latLngBounds([center[0] - lockMargin, center[1] - lockMargin], [center[0] + lockMargin, center[1] + lockMargin])
    );

    el.parentElement.querySelectorAll('[data-map-layer]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const layer = btn.getAttribute('data-map-layer');

            if (map.hasLayer(groups[layer])) {
                map.removeLayer(groups[layer]);
                btn.classList.add('opacity-50');
            } else {
                groups[layer].addTo(map);
                btn.classList.remove('opacity-50');
            }
        });
    });
}
