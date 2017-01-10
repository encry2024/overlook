@extends('layouts.app')

@section('content')
<?php  setlocale(LC_MONETARY, 'fil_PH'); ?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('edit_pool', $pool->id) }}" class="list-group-item"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                {{-- <a href="#" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload New Picture</a> --}}
                <a href="#delete_pool" data-toggle="modal" data-target="#DeletePool" class="list-group-item list-group-item-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete this Pool</a>
                <a href="{{ route('pool_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        <img src="{{ $pool->file_location }}" alt="" style="width: 10%;">&nbsp;&nbsp;{{ $pool->name }}
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
                                            <label for="inputPool" class="col-sm-3 control-label">Pool:</label>
                                            <div class="col-sm-8 ">
                                                <input name="name" class="form-control" id="inputPool" placeholder="Pool Name" value="{{ $pool->name }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputNumberOfPools" class="col-sm-3 control-label">No. of Pools:</label>
                                            <div class="col-sm-8 ">
                                                <input class="form-control" id="inputNumberOfPools" placeholder="Number of Available Pools" value="" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMinCapacity" class="col-sm-3 control-label">Min. Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input class="form-control" id="inputMinCapacity" placeholder="Minimum Capacity" value="{{ $pool->min_capacity }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMaxCapacity" class="col-sm-3 control-label">Max Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input class="form-control" id="inputMaxCapacity" placeholder="Maximum Capacity" value="{{ $pool->max_capacity }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="inputPrice" placeholder="Price per Room" value="{{ money_format('%n', $pool->price) }}" disabled>
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

<div class="modal fade" tabindex="-1" role="dialog" id="DeletePool">
    <form class="form-horizontal" action="{{ route('delete_pool', $pool->id) }}" id="delete_pool_form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="pool_id" id="pool_id" value="{{ $pool->id }}">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="pool_title">Delete <b>{{ $pool->name }}</b></h4>
                </div>
                <div class="modal-body">
                    <label for="">Are you sure you want to delete <kbd>{{ $pool->name }}</kbd></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Pool</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
@stop