<main class="min-h-screen">
    {{ $content }}
</main>

{{-- Lightbox Publik --}}
<div id="public-lightbox"
    class="fixed inset-0 z-[200] hidden flex-col items-center justify-center bg-black/90 p-4 sm:p-8"
    role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <button type="button" id="public-lightbox-close"
        class="absolute top-4 right-4 text-white/80 hover:text-white" aria-label="Tutup">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="public-lightbox-img" src="" alt=""
        class="max-h-[80vh] max-w-full object-contain rounded-lg shadow-2xl">
    <p id="public-lightbox-caption" class="text-center text-white/85 mt-3 text-sm max-w-2xl"></p>
</div>
