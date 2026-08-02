import './bootstrap';

import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { initInteractiveMap } from './map';

window.Alpine = Alpine;
window.initInteractiveMap = initInteractiveMap;

Alpine.start();

AOS.init({
    duration: 600,
    easing: 'ease-out-cubic',
    once: true,
    offset: 80,
    disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
});
