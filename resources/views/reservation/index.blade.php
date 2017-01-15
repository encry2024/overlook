@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
<div class="col-lg-12">
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">RESERVATIONS</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <a href="{{ route('create_reservation') }}" class="btn btn-success"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Book Walk-in Reservation</a>
                </div>

                <br>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 15%;">Reservation #</th>
                                            <th style="width: 20%;">Customer Name</th>
                                            <th style="width: 17%;">Room #</th>
                                            <th class="col-lg-2">Date Reserved</th>
                                            <th style="width: 10%;">Status</th>
                                            <th class="col-lg-3 text-right">Actions</th>
                                        </thead>

                                        <tbody>
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                <td>{{ ((($reservations->currentPage() - 1) * $reservations->perPage()) + ($ctr++) + 1) }}</td>
                                                <td>{{ $reservation->reference_number }}</td>
                                                <td>{{ $reservation->customer->name }}</td>
                                                <td>
                                                    @foreach($reservation->rooms as $room)
                                                        {{ $room->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($reservation->reservation_room as $res_room)
                                                        {{ date('F d, Y', strtotime($res_room->date_reserved)) }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    
                                                    @if ( $reservation->status == 'CHECKED-IN')
                                                        <label style="font-size: 13px;" class="label label-success">{{ $reservation->status }}</label>
                                                    @elseif ( $reservation->status == 'CHECKED-OUT')
                                                        <label style="font-size: 13px;" class="label label-success">{{ $reservation->status }}</label>
                                                    @elseif ($reservation->status == 'CANCELLED')
                                                        <label style="font-size: 13px;" class="label label-danger">{{ $reservation->status }}</label>
                                                    @else
                                                        <label style="font-size: 13px;" class="label label-info">{{ $reservation->status }}</label>
                                                    @endif
                                                </td>
                                                <td class="pull-right">
                                                    <div class="dropdown">
                                                        <button class="btn {{ $reservation->status == 'CANCELLED' ? 'btn-danger' : 'btn-default' }}  btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            @if($reservation->status != 'CANCELLED')
                                                                Action
                                                            @elseif($reservation->status == 'CANCELLED')
                                                                Reservation Cancelled
                                                            @endif
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                                            @if($reservation->status != 'CANCELLED')
                                                            <li><a href="{{ route('show_reservation', $reservation->id) }}">View Details</a></li>
                                                            <li><a href="{{ route('add_amenity', $reservation->id) }}">Add Amenity</a></li>
                                                            <li><a href="{{ route('checkin_reservation', $reservation->id) }}" >Check in</a></li>
                                                            <li><a href="#update_notification" data-toggle="modal" data-target="#updateNotifyMeForm">Check out</a></li>
                                                            <li><a href="#cancel" onclick="cancelReservation({{ $reservation->id }})" data-toggle="modal" data-target="#cancelReservationModal"> Cancel Reservation</a></li>
                                                            @elseif($reservation->status == 'CANCELLED')
                                                                <li><a href="#re-open-reservation" onclick="reopenReservation({{ $reservation->id }})" data-toggle="modal" data-target="#reopenReservationModal">Re-Open Reservation</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            {!! $reservations->appends(['filter' => Request::get('filter')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="cancelReservationModal">
    <form method="POST" id="CancelReservationForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cancel Reservation</h4>
                </div>
                <div class="modal-body">
                    <label>Are you sure you want to cancel this reservation?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Cancel Reservation</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="reopenReservationModal">
    <form method="POST" id="ReopenReservationForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reopen Reservation</h4>
                </div>
                <div class="modal-body">
                    <label>Are you sure you want to reopen this reservation?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reopen Reservation</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
<script>
    function cancelReservation(reservation_id) {
        var url = '{{ route("cancel_reservation", ":reservationId") }}';
            url = url.replace(":reservationId", reservation_id);

        document.getElementById('CancelReservationForm').action = url;
    }

    function reopenReservation(reservation_id) {
        var url = '{{ route("reopen_reservation", ":reservationId") }}';
            url = url.replace(":reservationId", reservation_id);

        document.getElementById('ReopenReservationForm').action = url;
    }
</script>
@stop