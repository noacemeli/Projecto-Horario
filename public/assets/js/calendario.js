document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        locale: "es-ES",


        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        
        events: 'http://localhost/KIWOP/Control_de_Fichajes/public/eventos',

    });

    calendar.render();
});
