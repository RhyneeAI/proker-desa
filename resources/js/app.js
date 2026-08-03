import './bootstrap';

import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { initInteractiveMap } from './map';

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

AOS.init({
    duration: 600,
    easing: 'ease-out-cubic',
    once: true,
    offset: 80,
    disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
});
