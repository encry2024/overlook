@extends('layouts.app')

@section('content')
<?php $total_child_price = 0; $total_adult_price = 0; ?>
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
                <a href="#update_reservation" class="list-group-item" data-toggle="modal" data-target="#CheckInModal"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Check-In</a>
                <a href="{{ route('show_reservation', $reservation->id) }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-size: 20px;">
                            Check-In Customer
                        </div>
                    </div>
                </div>

                @if($reservation->status == 'CHECKED-IN')
                <div class="row">
                    <div class="alert alert-info" role="alert" style="padding-bottom: 0px; padding-top: 0px;">
                        <h2 style="margin-top: 1rem;"><i class="fa fa-pencil"></i> Note: <label style="font-size: 13.5px;">This reservation's status is already checked-in and you may update the customer's <i>Overall Payment</i> by changing his/her discount.</label></h2>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="panel panel-{{ $reservation->status == 'CHECKED-IN' ? 'success' : 'default' }}">
                        @if($reservation->status == 'CHECKED-IN')
                            <div class="panel-heading" style="font-size: 20px;">{{ $reservation->status }}</div>
                        @endif
                        <div class="panel-body">
                            <form action="{{ route('update_reservation', $reservation->id) }}" class="form-horizontal" method="POST" id="UpdateReservationForm">
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

                                <div class="panel panel-success">
                                    <div class="panel-footer" style="font-size: 18px;">Discount
                                        <select name="discount_rate" id="discountDropdown" class="form-control discount_dropdown" onchange="applyDiscount(this);">
                                            @foreach($discounts as $discount)
                                                <option value="{{ $discount->deduction }}">{{ $discount->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="panel-heading" style="font-size: 20px;">Overall Payment: <span class="pull-right">&nbsp;<span id="discounted_price">
                                    @if(count($reservation->billing_reservation) == 0)
                                        {{ $total != 0 ? number_format($total, 2) : number_format($total_per_pax, 2) }}
                                    @else
                                        {{ number_format($reservation->billing_reservation->total_cost, 2) }}
                                    @endif
                                    </span></span></div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="CheckInModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Check-In Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to proceed to <code>Check-In</code> Customer: <kbd>{{ $reservation->customer->name }}</kbd>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('UpdateReservationForm').submit();">Check-In Customer {{ $reservation->customer->name }}</button>
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