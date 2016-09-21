@extends('layouts.app')


@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">RESERVATIONS</div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <a href="{{ route('create_reservation') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Make a Reservation</a>
                    </div>

                    <br>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th></th>
                                            <th>Resrv. #</th>
                                            <th>Name</th>
                                            <th>Room</th>
                                            <th>Reservation Date</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                        @foreach($reservations as $reservation)
                                            <tr class="{{ $reservation->status == 'CANCELLED' ? 'rsvr-cacncelled' : '' }}">
                                                <td>{{ ((($reservations->currentPage() - 1) * $reservations->perPage()) + ($ctr++) + 1) }}</td>
                                                <td>{{ $reservation->reference_number }}</td>
                                                <td>{{ $reservation->customer->name }}</td>
                                                <td>
                                                    @foreach($reservation->room as $rooms)
                                                        {{ $rooms->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($reservation->reservation_room as $res_room)
                                                        {{ $res_room->date_reserved }}<br>
                                                    @endforeach
                                                </td>
                                                @if ( $reservation->status == 'CHECKED-IN')
                                                <td class="positive">Customer has already CHECKED-IN</td>
                                                @elseif ( $reservation->status == 'CHECKED-OUT')
                                                    <td class="positive">CHECKED-OUT</td>
                                                @elseif ($reservation->status == 'CANCELLED')
                                                    <td class="negative">CANCELLED</td>
                                                @else
                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('show_customer_billing', $reservation->id) }}">Process</a>
                                                        <button class="btn btn-sm btn-danger" onclick="cancelReservation({{ $reservation->id }}, '{{ $reservation->reference_number }}')">Cancel</button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $reservations->appends(['filter' => Request::get('filter')])->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop