import { readFileSync } from 'node:fs';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// maplibre-gl-worker.mjs (loaded manually via `?url` in resources/js/map.js)
// imports a sibling chunk, maplibre-gl-shared.mjs, via a relative path. Vite's
// `?url` only copies the requested file, not what it imports, so that sibling
// chunk is emitted here under the exact filename the worker expects to find
// next to itself in `assets/`.
const copyMaplibreWorkerSharedChunk = () => ({
    name: 'copy-maplibre-worker-shared-chunk',
    generateBundle() {
        const sharedPath = fileURLToPath(
            new URL('./node_modules/maplibre-gl/dist/maplibre-gl-shared.mjs', import.meta.url)
        );
        this.emitFile({
            type: 'asset',
            fileName: 'assets/maplibre-gl-shared.mjs',
            source: readFileSync(sharedPath, 'utf-8'),
        });
    },
});

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
            ],
            refresh: true,
        }),
        copyMaplibreWorkerSharedChunk(),
    ],
});
