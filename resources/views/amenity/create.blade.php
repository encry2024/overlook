@extends('layouts.app')

@section('content')
<?php  setlocale(LC_MONETARY, 'fil_PH'); ?>
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-success alert-dismissible" role="alert" style="background-color: #d9534f;">
        <div class="container" style="color: white;"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
@if (count($errors) > 0)
<div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible">
        <i class="close icon"></i>
        <div class="header">
            Amenity was not able to create because of the following reason(s)
        </div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="#create_amenity" class="list-group-item list-group-item-success"
                onclick="document.getElementById('PostAmenityForm').submit();"><i class="fa fa-check"></i>&nbsp;&nbsp;Create Amenity</a>
                <a href="{{ route('amenity_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                         <i class="fa fa-plus"></i>&nbsp;&nbsp;Add Amenity
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-horizontal" action="{{ route('post_amenity') }}" method="POST" id="PostAmenityForm">
                                        {{ csrf_field() }}

                                        <div class="form-group ">
                                            <label for="inputItem" class="col-sm-3 control-label">Item:</label>
                                            <div class="col-sm-8 ">
                                                <input name="item" class="form-control" id="inputItem" placeholder="Amenity Item" value="{{ old('item') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputQuantity" class="col-sm-3 control-label">Quantity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="quantity" class="form-control" id="inputQuantity" placeholder="Amenity Quantity" value="{{ old('quantity') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">PHP</div>
                                                    <input name="price" class="form-control" id="inputPrice" placeholder="Amenity Price" value="{{ old('price') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputExpirationDate" class="col-sm-3 control-label">Expiration Date:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input name="expiration_date" id="expiration_date" type="text" value="{{ old('expiration_date') }}" class="form-control"><span class="input-group-addon"><i class="fa fa-th"></i></span>
                                                </div>
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
    </div>
</div>

<script>
    $("#expiration_date").datepicker({
        format: 'MM dd, yyyy',
        startDate: new Date()
    });
</script>
@stop