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
            Pool was not able to update because of the following reason(s)
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
                <a href="#update_pool" class="list-group-item list-group-item-success" data-toggle="modal" data-target="#UpdatePoolModal"><i class="fa fa-check"></i>&nbsp;&nbsp;Update Pool </a>
                <a href="{{ route('show_pool', $pool->id) }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        <img src="{{ $pool->file_location }}" alt="" style="width: 10%;">&nbsp;&nbsp;Edit {{ $pool->name }} Category <i class="fa fa-pencil"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="{{ route('show_room', $pool->id) }}" aria-controls="home" role="tab" data-toggle="tab">Information</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-horizontal" action="{{ route('pool_update', $pool->id) }}" method="POST" id="UpdatePoolForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <input type="hidden" name="pool_id" value="{{ $pool->id }}">

                                        <div class="form-group ">
                                            <label for="inputPool" class="col-sm-3 control-label">Name:</label>
                                            <div class="col-sm-8 ">
                                                <input name="name" class="form-control" id="inputPool" placeholder="Pool Name" value="{{ $pool->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMinCapacity" class="col-sm-3 control-label">Min. Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="min_capacity" class="form-control" id="inputMinCapacity" placeholder="Minimum Capacity" value="{{ $pool->min_capacity }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMaxCapacity" class="col-sm-3 control-label">Max Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="max_capacity" class="form-control" id="inputMaxCapacity" placeholder="Maximum Capacity" value="{{ $pool->max_capacity }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">PHP</div>
                                                    <input name="price" class="form-control" id="inputPrice" placeholder="Price per Head" value="{{ $pool->price }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription" class="col-sm-3 control-label">Description:</label>
                                            <div class="col-sm-8">
                                                <textarea name="description" class="form-control" id="poolDescription">{{ $pool->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label for="fileToUpload" class="col-sm-3 control-label">Upload Image:</label>
                                            <div class="col-sm-8">
                                                 <input name="fileToUpload" type="file" name="fileToUpload" accept="image/*.{jpg,png,jpeg}" class="form-control" id="fileToUpload" title=" test">
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

<div class="modal fade" tabindex="-1" role="dialog" id="UpdatePoolModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Confirmation</h4>
            </div>
            <div class="modal-body">
                <label for="">Are you sure you want to update <kbd>{{ $pool->name }}</kbd></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('UpdatePoolForm').submit();"><i class="fa fa-check"></i> Update Pool</button>
            </div>
        </div>
    </div>
</div>
@stop