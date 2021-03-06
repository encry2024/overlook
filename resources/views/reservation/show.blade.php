@extends('layouts.app')

@section('content')
<?php 
    $total_adult_price = 0; 
    $total_child_price = 0; 
    $total_per_pax = 0; 
    $total = 0;
    $total_amenities = 0;
    $overAllPayment = 0;
?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
            @if($reservation->status != 'CHECKED-OUT')
                <a href="{{ route('edit_reservation', $reservation->id) }}" class="list-group-item"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit Reservation</a>
                <a href="{{ route('checkin_reservation', $reservation->id) }}" class="list-group-item"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;Check-In</a>
                @if($reservation->status == 'CHECKED-IN')
                <a href="{{ route('checkout_reservation', $reservation->id) }}" class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Check-Out</a>
                @endif
                <a href="{{ route('edit_reservation', $reservation->id) }}" class="list-group-item list-group-item-danger"><i class="fa fa-remove"></i>&nbsp;&nbsp;Cancel Reservation</a>
                <a href="{{ route('reservations') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            @elseif($reservation->status == 'CHECKED-OUT')
                <a href="{{ route('reservations') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            @endif
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
            @if($reservation->status == 'CHECKED-OUT')
                <div class="row">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-size: 20px;">This Customer has already CHECKED-OUT</div>
                    </div>
                </div>
            @endif
                <div class="row">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-size: 20px;">RESERVATION REFERENCE: {{ $reservation->reference_number }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 17px;">Customer Details</div>
                                                <div class="panel-body">
                                                    <form action="" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-4">Name:</label>
                                                            <div class="col-sm-8"><input type="text" class="form-control" disabled value="{{ $reservation->customer->name }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-4">Contact Number:</label>
                                                            <div class="col-sm-8"><input type="text" class="form-control" disabled value="{{ $reservation->customer->contact_number }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-4">Address:</label>
                                                            <div class="col-sm-8"><textarea type="text" class="form-control" disabled>{{ $reservation->customer->address }}"</textarea></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-4">Email: </label>
                                                            <div class="col-sm-8"><input type="text" class="form-control" disabled value="{{ $reservation->customer->email }}"></div>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 17px;">Payment Details</div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>Customer Type</th>
                                                                <th>No# of Person</th>
                                                                <th>Price per Head</th>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($reservation->entrance_type->entrance_rates as $entrance_rate)
                                                                @if($entrance_rate->name == "Adult")
                                                                    <?php $total_adult_price = $reservation->no_of_adult * $entrance_rate->price; ?>
                                                                    <tr>
                                                                        <td>{{ $entrance_rate->name }}</td>
                                                                        <td>{{ $reservation->no_of_adult }}</td>
                                                                        <td>PHP&nbsp;&nbsp;{{ number_format($entrance_rate->price, 2) }}</td>
                                                                    </tr>
                                                                @elseif($entrance_rate->name == "Child")
                                                                    <?php $total_child_price = $reservation->no_of_child * $entrance_rate->price; ?>
                                                                    <tr>
                                                                        <td>{{ $entrance_rate->name }}</td>
                                                                        <td>{{ $reservation->no_of_child }}</td>
                                                                        <td>PHP&nbsp;&nbsp;{{ number_format($entrance_rate->price, 2) }}</td>
                                                                    </tr>
                                                                @elseif($entrance_rate->name == "70-100 pax")
                                                                    <?php $total_per_pax = 70 * $entrance_rate->price; ?>
                                                                    <tr>
                                                                        <td>{{ $entrance_rate->name }}</td>
                                                                        <td>70 (Default No. of Person)</td>
                                                                        <td>PHP&nbsp;&nbsp;{{ number_format($entrance_rate->price, 2) }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                            <?php $total = $total_child_price + $total_adult_price; ?>
                                                            <?php 
                                                                if($total == 0) {
                                                                    $total = $total_per_pax;
                                                                } else {
                                                                    $total = number_format($total, 2);
                                                                }
                                                            ?>
                                                            <tfoot>
                                                            <tr>
                                                                <td>Total Price</td>
                                                                <td></td>
                                                                <td>PHP &nbsp;&nbsp;{{ $total != 0 ? number_format($total, 2) : number_format($total_per_pax, 2) }}</td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                    <thead>
                                                        <th>Room #</th>
                                                        <th>Date Reserved</th>
                                                    </thead>
                                                    <tbody>
                                                    <?php $roomName = ''; ?>
                                                    @foreach($reservation->rooms as $room)
                                                        @if(($roomName == '') || ($roomName != $room->name))
                                                        <?php $roomName = $room->name; ?>
                                                        <tr>
                                                            <td>{{ $roomName }}</td>
                                                            <td>
                                                                @foreach($room->reservation_room as $getReservationDate)
                                                                    @if($getReservationDate->reservation_id == $reservation->id)
                                                                    <kbd>{{ $getReservationDate->date_reserved }}</kbd>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 17px;">Reservation Details</div>
                                                <div class="panel-body">
                                                    <form action="" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Payment Status:</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->status }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Number of Adult:</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->no_of_adult }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Number of Children:</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->no_of_child }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Booked Time:</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->name }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Package Type:</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->entrance->name }}"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="" class="control-label col-sm-5">Time Limit (hrs):</label>
                                                            <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->entrance->time_limit }}"></div>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 17px">Purchased Amenities</div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>Product</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total Price</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($purchased_amenities as $purchased_amenity)
                                                                <tr>
                                                                    <td>{{ $purchased_amenity->amenity->item }}</td>
                                                                    <td>{{ $purchased_amenity->qty }}</td>
                                                                    <td>{{ $purchased_amenity->amenity->price }}</td>
                                                                    <td>Php &nbsp;&nbsp;{{ $purchased_amenity->total_price }}</td>
                                                                </tr>
                                                                <?php $total_amenities += $purchased_amenity->total_price; ?>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td>Total Price</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>Php &nbsp;&nbsp;{{ number_format($total_amenities, 2) }}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 30px;">
                                                    Overall Payment: <span class="pull-right">&nbsp;<span id="discounted_price">
                                                    @if($discountReservation == 'NO-DISCOUNT')
                                                        Php {{ number_format($total + $total_amenities, 2) }}
                                                    @else
                                                        <?php 
                                                            $totalDeduction = ($total + $total_amenities) * $discount_reservation->discount->deduction; 
                                                        ?>
                                                        Php {{ number_format($total + $total_amenities - $totalDeduction, 2) }} (Discount Provided)
                                                    @endif
                                                </span></span></div>
                                            </div>
                                        </div>
                                    </div>
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