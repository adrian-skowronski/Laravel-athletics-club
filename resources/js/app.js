import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin ],
        events: '/api/events', // API endpoint to fetch events
        eventClick: function(info) {
            $('#eventModalLabel').text(info.event.title);
            $('#eventDescription').text(info.event.extendedProps.description);
            $('#eventDate').text(info.event.extendedProps.date);
            $('#eventTime').text(info.event.extendedProps.start_hour);
            $('#eventLink').attr('href', '/events/' + info.event.id);
            $('#eventModal').modal('show');
        }
    });
    calendar.render();
});
