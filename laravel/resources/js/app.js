import './bootstrap';
import * as bootstrap from 'bootstrap';
import '~resources/scss/app.scss';
import Alpine from 'alpinejs';
import.meta.glob([
    '../img/**'
])


window.Alpine = Alpine;

Alpine.start();
