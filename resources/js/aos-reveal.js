// Reveal on scroll via IntersectionObserver — re-animates on BOTH scroll directions.
// AOS 2.x only removes `aos-animate` for elements below the viewport, so elements
// scrolled past above never animate on scroll-up. Replacing AOS.init with this
// keeps the AOS CSS animations but toggles the class in both directions.
export default function initAosReveal({ duration = 600, easing = 'ease-out-cubic' } = {}) {
    const els = Array.from(document.querySelectorAll('[data-aos]'));
    if (!els.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        els.forEach((el) => el.classList.add('aos-animate'));
        return;
    }

    document.body.setAttribute('data-aos-duration', String(duration));
    document.body.setAttribute('data-aos-easing', easing);

    const viewportHeight = window.innerHeight;
    els.forEach((el) => {
        el.classList.add('aos-init');
        const rect = el.getBoundingClientRect();
        if (rect.top < viewportHeight && rect.bottom > 0) el.classList.add('aos-animate');
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => entry.target.classList.toggle('aos-animate', entry.isIntersecting));
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    els.forEach((el) => observer.observe(el));
}
