@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('reservations') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-lg-12 col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">BOOK RESERVATION</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                selectable: true,
                height: 500,
                header: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'month'
                },

                select: function( start, end) {
                    var check = start.format();
                    var today = moment().format();

                    if(check < today) {
                    } else {
                        var redirect_url = '{{ route('reservation_date', ':reservationDate') }}';
                        redirect_url = redirect_url.replace(':reservationDate', start.format()+'&'+end.format());

                        window.location = redirect_url;
                    }
                },
                eventSources: [
                    '{{ route('reserved_rooms') }}'
                ],

                eventClick: function(event) {
                    if (event.url) {
                        window.open(event.url);
                        return false;
                    }
                },
                eventDurationEditable: true,
                eventLimit: true,
                editable: true
            });
        });
    </script>
@endsection
