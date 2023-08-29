<html lang='en'>

<head>
    <meta charset='utf-8' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.8/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        const SITEURL = "{{ url('/') }}";
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {{ $events }}
                dateClick: function(info) {
                    alert('Clicked on: ' + info.dateStr);
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('Current view: ' + info.view.type);
                    // change the day's background color just for fun
                    info.dayEl.style.backgroundColor = 'red';
                    $.ajaxSetup({

                    headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                    });
                    $.ajax({
                        
                        url: SITEURL + '/saveday',

                        data: {
                            calendar_date: info.dateStr,
                            type: 'add'
                        },

                        type: "POST",

                        success: function(data) {

                            alert('correct')



                            // calendar.fullCalendar('renderEvent',

                            //     {

                            //         id: data.id,

                            //         title: title,

                            //         start: start,

                            //         end: end,

                            //         allDay: allDay

                            //     }, true);



                            calendar.fullCalendar('unselect');

                        }

                    });
                }
            });
            calendar.render();
        });
    </script>
</head>

<body>
    <div id='calendar'></div>
