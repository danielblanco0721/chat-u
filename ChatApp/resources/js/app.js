import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':3000'
});

