@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-{{ Session::get('alertType') }} alert-dismissible" role="alert" style="background-color: {{ Session::get('alertColorHash') }};">
        <div class="container" style="color: white;"><i class="fa fa-{{ Session::get('alertIcon') }}"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
@if (count($errors) > 0)
<div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible">
        <i class="close icon"></i>
        <div class="header">
            <b><i class="fa fa-exclamation-triangle"></i> Reservation was cancelled because of the following reason(s)</b>
        </div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
                <a class="list-group-item list-group-item-success" href="#" onclick='document.getElementById("saveCustomerReservationDetails").submit();'><i class="fa fa-check"></i>&nbsp;&nbsp;Book Reservation</a>
                <a href="{{ route('reservations') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            @if($rooms->isEmpty())
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="alert alert-danger" role="alert" style="background-color: #d9534f;">
                        <label href="#" class="alert-link" style="color: white;"><i class="fa fa-exclamation-triangle"></i> Warning! Your Room Categories doesn't have any rooms yet. Cannot proceed to Book Reservation. Visit <kbd style="background-color: white !important; cursor: "><a href="{{ route('room_category_index') }}">Room Category</a></kbd> to add rooms.</label>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;"><i class="fa fa-book"></i>&nbsp;&nbsp;Create Walk-in Reservation</div>
                        <div class="panel-body">
                            <form class="form-horizontal" action="{{ route('save_customer_reservation_details') }}" method="POST" id="saveCustomerReservationDetails">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                                    <label for="inputName" class="col-sm-3 control-label">First Name:</label>
                                    <div class="col-sm-9">
                                        <input name="first_name" class="form-control" id="inputName" placeholder="First Name" value="{{ old('first_name') }}">

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label for="inputName" class="col-sm-3 control-label">Last Name:</label>
                                    <div class="col-sm-9">
                                        <input name="last_name" class="form-control" id="inputName" placeholder="Last Name" value="{{ old('last_name') }}">

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="inputEmail" class="col-sm-3 control-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                                    <label for="inputContact" class="col-sm-3 control-label">Contact No#:</label>
                                    <div class="col-sm-9">
                                        <input name="contact" class="form-control" id="inputContact" placeholder="Contact Number" value="{{ old('contact') }}">

                                        @if ($errors->has('contact'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="inputAddress" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control" id="inputAddress" placeholder="Address">{{ old('address') }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAdults" class="col-sm-3 control-label">Starting Date of Stay:</label>
                                    <div class="col-sm-9">
                                        <input name="start_date" class="form-control" id="inputAdults" placeholder="Starting Date of Stay" value="{{ date('F d, Y', strtotime($start_date)) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputChildren" class="col-sm-3 control-label">End of Stay</label>
                                    <div class="col-sm-9">
                                        <input  name="end_date" class="form-control" id="inputChildren" placeholder="End of Stay" value="{{ date('F d, Y', strtotime($end_date)) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputChildren" class="col-sm-3 control-label">Number of Days</label>
                                    <div class="col-sm-9">
                                        <input  name="no_of_days" class="form-control" id="inputChildren" placeholder="End of Stay" value="{{ $days = (strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('no_of_adult') ? 'has-error' : '' }}">
                                    <label for="inputAdults" class="col-sm-3 control-label">No. of Adults:</label>
                                    <div class="col-sm-9">
                                        <input name="no_of_adult" class="form-control" id="inputAdults" placeholder="Number of Adults">

                                        @if ($errors->has('no_of_adult'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_of_adult') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('no_of_child') ? 'has-error' : '' }}">
                                    <label for="inputChildren" class="col-sm-3 control-label">No. of Children:</label>
                                    <div class="col-sm-9">
                                        <input name="no_of_child" class="form-control" id="inputChildren" placeholder="Number of Children">

                                        @if ($errors->has('no_of_child'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_of_child') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('period') ? 'has-error' : '' }}">
                                    <label for="inputChildren" class="col-sm-3 control-label">Choose Package:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="period">
                                            @foreach($packages as $package)
                                                @foreach($package->entrance_type as $package_type)
                                                    @if($package->name == "Non Package")
                                                        <option name="package_type" value="{{ $package_type->id }}">({{ $package->name }}) {{ $package_type->name }}</option>
                                                    @elseif($package->name == "Package")
                                                        <option name="package_type" value="{{ $package_type->id }}">({{ $package->name }}) {{ $package_type->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>

                                        @if ($errors->has('period'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('period') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('rooms') ? 'has-error' : '' }}">
                                    <label for="inputChildren" class="col-sm-3 control-label">Choose Room(s):</label>
                                    <div class="col-sm-9">
                                        <input class="client_dropdown selectize-control single" id="room_drop" name="rooms">

                                        @if ($errors->has('rooms'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rooms') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        nf = new Intl.NumberFormat(["en-PHP"], {
            style: "currency",
            currency: "Php",
            maximumFractionDigit: 1
        });

        $('#room_drop').selectize({
            valueField: 'room_id',
            labelField: 'room_name',
            searchField: ['room_name', 'category_name'],
            placeholder: '-- Search Rooms --',
            render: {
                option: function(item, escape) {
                    currency = nf.format(parseFloat(item.category_price));
                    var convertedCurrency       = currency.slice(0, 3) + " " + currency.slice(3);

                    return '<div>' +
                        '<span class="title">' +
                            '<span class="name"><b>' + escape(item.room_name) + '</b>'+ '</span>' +
                        '</span>' +
                        '<br>' +
                        '<span class="description"><i>Category: <b>' + escape(item.category_name) + '</b> / </i></span>' +
                        '<span class="description"><i>Price per room: <b>' + escape(convertedCurrency) + '</b></i></span>' +
                        '<span class="description"><i> / Min. Capacity: <b>' + escape(item.category_min) + '</b></i></span>' +
                        '<span class="description"><i> / Max. Capacity: <b>' + escape(item.category_max) + '</b></i></span>' +
                    '</div>';
                }
            },
            open: function(query, callback) {
                $.ajax({
                    url: "{{ URL::to('/') }}/getRooms/",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        dev_name: query,
                    },
                    error: function() {
                        console.log("failed");
                    },
                    success: function(res) {
                        console.log(res);
                        callback(res);
                    }
                });
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: "{{ URL::to('/') }}/getRooms/" + query,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        query: query,
                    },
                    error: function() {
                        console.log("failed");
                    },
                    success: function(res) {
                        console.log(res);
                        callback(res);
                    }
                });
            }
        });
    });
</script>
@stop