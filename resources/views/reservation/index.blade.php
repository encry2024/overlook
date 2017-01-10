@extends('layouts.app')

@section('content')
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
                                            <th style="width: 5%;"></th>
                                            <th style="width: 15%;">Reservation #</th>
                                            <th style="width: 20%;">Customer Name</th>
                                            <th style="width: 17%;">Room #</th>
                                            <th class="col-lg-2">Date Reserved</th>
                                            <th style="width: 10%;">Status</th>
                                            <th class="col-lg-3"></th>
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
                                                    {{ $reservation->status }}
                                                    {{--@if ( $reservation->status == 'CHECKED-IN')
                                                        <td class="positive">Customer has already CHECKED-IN</td>
                                                    @elseif ( $reservation->status == 'CHECKED-OUT')
                                                        <td class="positive">CHECKED-OUT</td>
                                                    @elseif ($reservation->status == 'CANCELLED')
                                                        <td class="negative">CANCELLED</td>
                                                    @else
                                                    <td>
                                                        <a class="ui small positive button" href="{{ route('cust_billing', $reservation->id) }}">process</a>
                                                        <button class="ui small negative button cancel_reservation_button" onclick="cancelReservation({{ $reservation->id }}, '{{ $reservation->reference_number }}')">cancel</button>
                                                    </td>
                                                    @endif--}}
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            Actions
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                                            <li><a href="#delivered" data-toggle="modal" data-target="#changeItemDeliveryStatus">View Details</a></li>
                                                            <li><a href="#delivered" data-toggle="modal" data-target="#changeItemDeliveryStatus">Check in</a></li>
                                                            <li><a href="#update_notification" data-toggle="modal" data-target="#updateNotifyMeForm">Check out</a></li>
                                                            <li><a href="#delayed" data-toggle="modal" data-target="#updateDeliveryStatusForm"> Cancel Reservation</a></li>
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
@stop