// Reveal on scroll via IntersectionObserver — re-animates on BOTH scroll
// directions, but only after the element has fully left the viewport.
//
// AOS 2.x never re-animates elements that scrolled past above. A naive
// toggle on `isIntersecting` flickers: fade-up/down transforms move the
// element back into view, the observer fires again, and the class flaps.
// Enter/leave observers with hysteresis (leaveGap > CSS travel) break
// that loop. visualViewport resizes (mobile URL bar) are ignored.

export default function initAosReveal({ duration = 500, easing = 'ease-out-cubic' } = {}) {
    const els = Array.from(document.querySelectorAll('[data-aos]'));
    if (!els.length) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        els.forEach((el) => el.classList.add('aos-init', 'aos-animate'));
        return;
    }

    document.body.setAttribute('data-aos-duration', String(duration));
    document.body.setAttribute('data-aos-easing', easing);

    const isMobile = window.matchMedia('(max-width: 640px)').matches;
    // Must exceed the CSS translate (100px desktop / 28px mobile) so
    // un-animating cannot push the node back into the enter observer.
    const leaveGap = isMobile ? 80 : 160;

    if (isMobile) {
        els.forEach((el) => el.removeAttribute('data-aos-delay'));
    }

    const inViewport = (el) => {
        const rect = el.getBoundingClientRect();
        const vh = window.innerHeight || document.documentElement.clientHeight;
        return rect.bottom > 0 && rect.top < vh;
    };

    els.forEach((el) => {
        el.classList.add('aos-init');
        if (inViewport(el)) el.classList.add('aos-animate');
    });

    let ignoreUntil = 0;
    let syncTimer = 0;
    const bumpIgnore = () => {
        ignoreUntil = performance.now() + 220;
        clearTimeout(syncTimer);
        syncTimer = window.setTimeout(() => {
            els.forEach((el) => {
                if (inViewport(el)) el.classList.add('aos-animate');
            });
        }, 240);
    };
    window.addEventListener('resize', bumpIgnore, { passive: true });
    window.visualViewport?.addEventListener('resize', bumpIgnore, { passive: true });

    const enter = new IntersectionObserver((entries) => {
        if (performance.now() < ignoreUntil) return;
        entries.forEach((entry) => {
            if (entry.isIntersecting) entry.target.classList.add('aos-animate');
        });
    }, { threshold: 0, rootMargin: '0px' });

    const leave = new IntersectionObserver((entries) => {
        if (performance.now() < ignoreUntil) return;
        entries.forEach((entry) => {
            if (!entry.isIntersecting) entry.target.classList.remove('aos-animate');
        });
    }, { threshold: 0, rootMargin: `${leaveGap}px 0px` });

    els.forEach((el) => {
        enter.observe(el);
        leave.observe(el);
    });
}
