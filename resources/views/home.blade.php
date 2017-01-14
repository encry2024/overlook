@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-{{ Session::get('alertType') }} alert-dismissible" role="alert">
        <div class="container"><i class="fa fa-{{ Session::get('alertIcon') }}"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
<div class="col-lg-12">
    
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">DASHBOARD</div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
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
            $(".ui.dropdown").dropdown({
                allowAdditions: true,
            });

            $('#calendar').fullCalendar({
                selectable: false,
                height: 550,
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
                        
                    }
                },

                eventSources: [
                    '{{ route('dashboardFetchReservedRooms') }}'
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
            })
        });
</script>
@endsection
