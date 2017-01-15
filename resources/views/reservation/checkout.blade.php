@extends('layouts.app')

@section('content')
<?php 
    $total_adult_price = 0; 
    $total_child_price = 0; 
    $total_per_pax = 0; 
    $total = 0;
    $total_amenities = 0;
    $overAllPayment = 0;
    $totalDeduction = 0;
?>
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
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
                <a href="#"  class="list-group-item" {!! $reservation->status != 'CHECKED-OUT' ? 'data-toggle="modal" data-target="#CheckOutModal"' : '' !!}><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Check-Out</a>
                <a href="{{ route('show_reservation', $reservation->id) }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-size: 20px;">
                            Check-Out Customer
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-{{ $reservation->status == 'CHECKED-IN' ? 'success' : 'default' }}">
                        @if($reservation->status == 'CHECKED-IN')
                            <div class="panel-heading" style="font-size: 20px;">{{ $reservation->status }}</div>
                        @endif
                        <div class="panel-body">
                            <form action="{{ route('checkout_customer', $reservation->id) }}" class="form-horizontal" method="POST" id="UpdateReservationForm">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}

                                <div class="row">
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-4">Reference Number:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $reservation->reference_number }}" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-4">Customer Name:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $reservation->customer->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-4">Address:</label>
                                        <div class="col-sm-5">
                                            <textarea type="text" class="form-control" disabled>{{ $reservation->customer->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-4">Contact Number:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $reservation->customer->contact_number }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-4">E-mail:</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $reservation->customer->email }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <hr>
                                </div>

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
                                            if($total == 0 ) {
                                                $total = $total_per_pax;
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

                                <div class="row">
                                    <hr>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Payment Status:</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->status }}"></div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Number of Adult:</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->no_of_adult }}"></div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Number of Children:</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->no_of_child }}"></div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Booked Time:</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->name }}"></div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Package Type:</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->entrance->name }}"></div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-sm-4">Time Limit (hrs):</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" disabled value="{{ $reservation->entrance_type->entrance->time_limit }}"></div>
                                </div>

                                <div class="row">
                                    <hr>
                                </div>

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

                                <div class="row">
                                    <hr>
                                </div>

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

                                <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default" style="border-top-color: #5bc0de; border-top-width: 2px;">
                                                <div class="panel-heading" style="font-size: 30px;">
                                                    Overall Payment (Amenities Included): <span class="pull-right">&nbsp;<span id="discounted_price">
                                                    @if($discountReservation == 'NO-DISCOUNT')
                                                        Php {{ number_format($total + $total_amenities, 2) }}
                                                    @elseif($discountReservation == "WITH-DISCOUNT")
                                                        <?php $totalDeduction = ($total + $total_amenities); ?>
                                                        {{ number_format($total + $total_amenities - ($totalDeduction * $discount_reservation->discount->deduction), 2) }} (Discount Provided)
                                                    @endif
                                                </span></span></div>
                                            </div>
                                        </div>
                                    </div>
                                <input type="hidden" name="overall_payment" value="{{ $total + $total_amenities - ($totalDeduction * $discount_reservation->discount->deduction) }}">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="CheckOutModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Check-Out Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to proceed to <code>Check-Out</code> Customer: <kbd>{{ $reservation->customer->name }}</kbd>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('UpdateReservationForm').submit();">Check-Out Customer {{ $reservation->customer->name }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function applyDiscount(deduction) {
        console.log("{{ $total }}");
        var total_cost = "{{ $total }}",
            discounted_price = document.getElementById('discounted_price').innerHTML,
            deduction = document.getElementById("discountDropdown").value;


            nf = new Intl.NumberFormat(["en-PHP"], {
                style: "currency",
                currency: "Php",
                maximumFractionDigit: 1
            });


        currency = nf.format(parseFloat(total_cost - (total_cost * deduction)));
        var convertedCurrency       = currency.slice(0, 3) + " " + currency.slice(3);
        document.getElementById('discounted_price').innerHTML = convertedCurrency;

    }
</script>
@stop