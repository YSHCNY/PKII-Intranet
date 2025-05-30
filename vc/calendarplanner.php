<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullCalendar CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body>
<div class=" px-5 pt-5 pb-2 <?php echo $hero?>" >
		<div class="text-center"><h3 class = 'mb-5 mt-2 py-5 fw-bold text-uppercase text-white'>My Event Planner</h3></div>
        </div>
<div class="container shadow p-4 my-5">
    <p class="<?php echo $subtext?> fst-italic">Note: Click on a date or click and drag to add an event. Click on an existing event to update or delete it. Drag events to different dates to reschedule seamlessly</p>
        <div id='calendar'></div>
    </div>

    <!-- Event Modal -->
    <div class="modal " id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add/Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="eventId">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Event Title</label>
                        <input type="text" class="form-control" placeholder = 'Event Here..' id="eventTitle">
                    </div>
                    <div class="mb-3">
    <label for="eventStartDate" class="form-label">Start Date</label>
    <input type="text" class="form-control datetime-picker" placeholder = 'Select date & time' id="eventStartDate">
</div>
<div class="mb-3">
    <label for="eventEndDate" class="form-label">End Date</label>
    <input type="text" class="form-control datetime-picker" placeholder = 'Select date & time' id="eventEndDate">
</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEvent">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var employeeid = <?php echo $employeeid0 ?>;
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                selectable: true,
                droppable: true,
                 headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
                },
                 timeZone: 'Asia/Hong_Kong',
                 eventTimeFormat: { 
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false 
                    },
                    events: function(fetchInfo, successCallback, failureCallback) {
        fetch('fetch_event.php?employeeid=' + employeeid)
            .then(response => response.json())
            .then(userEvents => {
                fetch('https://date.nager.at/api/v3/PublicHolidays/2025/PH')
                    .then(response => response.json())
                    .then(holidayData => {
                        let holidayEvents = holidayData.map(holiday => ({
                            title: holiday.localName,
                            start: holiday.date,
                            allDay: true,
                            color: '#ff5733', // Custom color for holidays
                            textColor: '#ffffff',
                        }));
                        successCallback(userEvents.concat(holidayEvents));
                    })
                    .catch(error => {
                        console.error('Error fetching holidays:', error);
                        successCallback(userEvents);
                    });
            })
            .catch(error => {
                console.error('Error fetching user events:', error);
                successCallback([]);
            });
    },
                select: function(info) {
                    $('#eventId').val('');
                    $('#eventTitle').val('');
                    $('#eventStartDate').val(info.startStr);
                    $('#eventEndDate').val(info.endStr);
                    $('#eventModal').modal('show');
                },
                eventDrop: function(info) {
                    $.post('update_event.php', {
                        id: info.event.id,
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : info.event.start.toISOString()
                    });
                },
                eventClick: function(info) {
                    $('#eventId').val(info.event.id);
                    $('#eventTitle').val(info.event.title);
                    $('#eventDate').val(info.event.start.toISOString().slice(0, 16));
                    $('#eventModal').modal('show');
                }
            });
            calendar.render();

            $('#saveEvent').click(function() {
                var id = $('#eventId').val();
                var title = $('#eventTitle').val();
                var start = $('#eventStartDate').val();
                var end = $('#eventEndDate').val();

                if (id) {
                    $.post('update_event.php', { id: id, start: start, end: end }, function() {
                        calendar.refetchEvents();
                        $('#eventModal').modal('hide');
                    });
                } else {
                    $.post('save_event.php', { employeeid: employeeid, title: title, start: start, end: end }, function() {
                        calendar.refetchEvents();
                        $('#eventModal').modal('hide');
                    });
                }
            });


            

            $('#deleteEvent').click(function() {
                var id = $('#eventId').val();
                if (id) {
                    $.post('delete_event.php', { id: id }, function() {
                        calendar.refetchEvents();
                        $('#eventModal').modal('hide');
                    });
                }
            });

            $('#calendarView').change(function() {
                calendar.changeView($(this).val());
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
    flatpickr(".datetime-picker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        allowInput: true
    });
});
    </script>
</body>
</html>
