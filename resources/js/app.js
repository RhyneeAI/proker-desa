import './bootstrap';

import Alpine from 'alpinejs';
import 'aos/dist/aos.css';
import { initInteractiveMap } from './map';
import initAosReveal from './aos-reveal';

window.Alpine = Alpine;
window.initInteractiveMap = initInteractiveMap;

// Count-up: animasi angka dari 0 ke target saat elemen terlihat
Alpine.data('countUp', (target, { duration = 1500, decimals = 0 } = {}) => ({
    value: 0,
    started: false,
    init() {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !this.started) {
                this.started = true;
                this.animate();
                observer.disconnect();
            }
        }, { threshold: 0.3 });
        observer.observe(this.$el);
    },
    animate() {
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            this.value = target * eased;
            if (p < 1) requestAnimationFrame(step);
            else this.value = target;
        };
        requestAnimationFrame(step);
    },
    get formatted() {
        return this.value.toLocaleString('id-ID', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals,
        });
    },
}));

// Auto-slide horizontal untuk daftar berita
Alpine.data('newsSlider', () => ({
    timer: null,
    reduced() {
        return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    },
    init() {
        this.play();
    },
    play() {
        if (this.timer || this.reduced()) return;
        this.timer = setInterval(() => this.next(), 4500);
    },
    pause() {
        clearInterval(this.timer);
        this.timer = null;
    },
    slide(direction) {
        const track = this.$refs.track;
        if (!track) return;
        const card = track.querySelector('.news-slide');
        if (!card) return;
        const step = card.offsetWidth + 24;
        const max = track.scrollWidth - track.clientWidth;
        let x = track.scrollLeft + direction * step;
        if (direction > 0 && x > max) x = 0;
        if (direction < 0 && x < 0) x = max;
        track.scrollTo({ left: x, behavior: 'smooth' });
    },
    next() {
        this.slide(1);
    },
    prev() {
        this.slide(-1);
    },
}));

Alpine.start();

// Lightbox publik: klik elemen [data-lightbox] -> tampilkan gambar + caption
(function () {
    const overlay = document.getElementById('public-lightbox');
    const img = document.getElementById('public-lightbox-img');
    const cap = document.getElementById('public-lightbox-caption');
    const closeBtn = document.getElementById('public-lightbox-close');
    if (!overlay || !img || !cap || !closeBtn) return;

    const open = (src, alt, caption) => {
        img.src = src;
        img.alt = alt || '';
        cap.textContent = caption || '';
        cap.style.display = caption ? '' : 'none';
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
    };
    const close = () => {
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        img.src = '';
        document.body.style.overflow = '';
    };

    document.addEventListener('click', (e) => {
        const t = e.target.closest('[data-lightbox]');
        if (!t) return;
        e.preventDefault();
        open(t.dataset.lightbox, t.getAttribute('alt') || '', t.dataset.caption || '');
    });

    closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) close();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
    });
})();

// Reveal on scroll — re-animates on BOTH directions (scroll down & scroll up)
if (document.readyState !== 'loading') initAosReveal();
else document.addEventListener('DOMContentLoaded', () => initAosReveal());
