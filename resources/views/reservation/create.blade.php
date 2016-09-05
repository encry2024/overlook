@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 col-lg-push-0-2">
                <div class="row">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Create Reservation</a>
                        <a href="{{ route('reservations') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;"><i class="fa fa-book"></i>&nbsp;&nbsp;Make a Reservation</div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-3 control-label">Customer Name:</label>
                                    <div class="col-sm-5">
                                        <input name="name" class="form-control" id="inputName" placeholder="Customer Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-3 control-label">Email:</label>
                                    <div class="col-sm-5">
                                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputContact" class="col-sm-3 control-label">Contact No#:</label>
                                    <div class="col-sm-5">
                                        <input name="contact" class="form-control" id="inputContact" placeholder="Contact Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-5">
                                        <input name="address" class="form-control" id="inputAddress" placeholder="Address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAdults" class="col-sm-3 control-label">No. of Adults:</label>
                                    <div class="col-sm-5">
                                        <input name="no_of_adult" class="form-control" id="inputAdults" placeholder="Number of Adults">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputChildren" class="col-sm-3 control-label">No. of Children:</label>
                                    <div class="col-sm-5">
                                        <input name="no_of_children" class="form-control" id="inputChildren" placeholder="Number of Children">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputChildren" class="col-sm-3 control-label">Choose Package:</label>
                                    <div class="col-sm-5">
                                        <select class="form-control">
                                            @foreach($packages as $package)
                                                @foreach($package->entrance_type as $package_type)
                                                    @if($package->name == "Non Package")
                                                    <option name="package_type" value="ptype-{{ $package_type->id }}">({{ $package->name }}) {{ $package_type->name }}</option>
                                                    @elseif($package->name == "Package")
                                                    <option name="package_type" value="ptype-{{ $package_type->id }}">({{ $package->name }}) {{ $package_type->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputChildren" class="col-sm-3 control-label">Choose Room(s):</label>
                                    <div class="col-sm-5">
                                        <select class="form-control">
                                            @foreach($packages as $package)
                                                @foreach($package->entrance_type as $package_type)
                                                    <option name="package_type" value="ptype-{{ $package_type->id }}">({{ $package->name }}) {{ $package_type->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
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
@stop