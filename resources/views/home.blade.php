@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 22px;">DASHBOARD</div>
                    </div>
                </div>

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

        $('#calendar').fullCalendar({
            selectable: false,
            height: 500,
            header: {
                left: 'prev,next,today',
                center: 'title',
                right: 'month'
            },

/*            select: function( start, end) {
                var check = start.format();
                var today = moment().format();

                if(check < today) {
                } else {

                }
            },

            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            },*/
            editable: true
        });
    });
</script>
@endsection
