import './bootstrap';

import Alpine from 'alpinejs';
import * as L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { initInteractiveMap } from './map';

window.Alpine = Alpine;
window.L = L;
window.initInteractiveMap = initInteractiveMap;

Alpine.start();
