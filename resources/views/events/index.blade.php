@extends('layouts.app')

@section('content')
<div class="container">
    <div id="calendar"></div>
</div>

<!-- Modal to show event details -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="eventDescription"></p>
                <p id="eventDate"></p>
                <p id="eventTime"></p>
                <a id="eventLink" href="#" class="btn btn-primary">View Details</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid' ],
            events: '/api/events',
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
</script>
@endpush
