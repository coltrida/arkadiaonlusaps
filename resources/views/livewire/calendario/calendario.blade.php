<div>
<div id="calendar"></div>

    @assets
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    @endassets

<script>
    document.addEventListener('livewire:initialized', function() {
        let component = @this;   // questo rappresenta il componente

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Vista iniziale
            locale: 'it',
            firstDay: 1,
            showNonCurrentDates: false,
            /*events: [
                { title: 'Event 1', start: '2025-01-12' },
                { title: 'Event 2', start: '2025-01-05', end: '2025-01-07' },
            ],*/
            events: component.appuntamenti,
        });
        calendar.render();

        // Ascolta gli eventi Livewire
        Livewire.on('SalvaAppuntamento', (appuntamento) => {
            calendar.addEvent(appuntamento); // Aggiungi il nuovo evento
        });
    });
</script>
</div>
