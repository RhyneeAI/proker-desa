import './bootstrap';

import Alpine from 'alpinejs';
import { initInteractiveMap } from './map';

window.Alpine = Alpine;
window.initInteractiveMap = initInteractiveMap;

Alpine.start();
