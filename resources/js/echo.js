import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '1224a88e4ae0610949c6',
    cluster: 'eu',
    forceTLS: true
});

window.Echo.channel('appuntamenti')
    .listen('SalvaAppuntamento', (e) => {
        alert('nuovo post creato' + e.appuntamento)
        console.log('ok')
  //      Livewire.emit('SalvaAppuntamento', e.appuntamento);
    });
