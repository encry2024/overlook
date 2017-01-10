@extends('layouts.app')

@section('content')
<?php  setlocale(LC_MONETARY, 'fil_PH'); ?>
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
@if (count($errors) > 0)
<div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible">
        <i class="close icon"></i>
        <div class="header">
            Amenity was not able to update because of the following reason(s)
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
                <a href="#update_amenity" class="list-group-item list-group-item-success"
                onclick="document.getElementById('UpdateAmenityForm').submit();"><i class="fa fa-check"></i>&nbsp;&nbsp;Update Amenity</a>
                <a href="{{ route('show_amenity', $amenity->id) }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">
                            Edit {{ $amenity->item }} Amenity <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#" aria-controls="home" role="tab" data-toggle="tab">Information</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-horizontal" action="{{ route('update_amenity', $amenity->id) }}" method="POST" id="UpdateAmenityForm">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <input type="hidden" name="amenity_id" value="{{ $amenity->id }}">

                                        <div class="form-group ">
                                            <label for="inputAmenity" class="col-sm-3 control-label">Amenity Item:</label>
                                            <div class="col-sm-8 ">
                                                <input name="item" class="form-control" id="inputAmenity" placeholder="Amenity Item" value="{{ $amenity->item }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputQuantity" class="col-sm-3 control-label">Quantity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="quantity" class="form-control" id="inputQuantity" placeholder="Quantity" value="{{ $amenity->quantity }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">PHP</div>
                                                    <input name="price" class="form-control" id="inputPrice" placeholder="Price" value="{{ $amenity->price }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputExpirationDate" class="col-sm-3 control-label">Expiration Date:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date">
                                                    <input name="expiration_date" id="expiration_date" type="text" value="{{ date('F d, Y', strtotime($amenity->expiration_date)) }}" class="form-control"><span class="input-group-addon"><i class="fa fa-th"></i></span>
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