@extends('layouts.app')

@section('content')
<?php  setlocale(LC_MONETARY, 'fil_PH'); ?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('edit_amenity', $amenity->id) }}" class="list-group-item"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                <a href="#delete_amenity" data-toggle="modal" data-target="#DeleteAmenity" class="list-group-item list-group-item-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete this Amenity</a>
                <a href="{{ route('amenity_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">
                            {{ strtoupper($amenity->item) }}
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
                                    <form class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="form-group ">
                                            <label for="inputamenity" class="col-sm-3 control-label">Item Name:</label>
                                            <div class="col-sm-8 ">
                                                <input name="name" class="form-control" id="inputamenity" placeholder="amenity Name" value="{{ $amenity->item }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputQuantity" class="col-sm-3 control-label">Quantity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="quantity" class="form-control" id="inputQuantity" placeholder="Amenity Quantity" value="{{ $amenity->quantity }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="inputPrice" placeholder="Price per Room" value="{{ number_format($amenity->price, 2) }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputExpirationDate" class="col-sm-3 control-label">Expiration Date:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="inputExpirationDate" placeholder="Expiration Date" value="{{ date('F d, Y', strtotime($amenity->expiration_date)) }}" disabled>
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

<div class="modal fade" tabindex="-1" role="dialog" id="DeleteAmenity">
    <form class="form-horizontal" action="{{ route('delete_amenity', $amenity->id) }}" id="delete_amenity_form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="amenity_id" id="amenity_id" value="{{ $amenity->id }}">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="amenity_title">Delete <b>{{ $amenity->item }}</b></h4>
                </div>
                <div class="modal-body">
                    <label for="">Are you sure you want to delete <code>{{ $amenity->item }}</code></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete Amenity</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
@stop