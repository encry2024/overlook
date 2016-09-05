@extends('layouts.app')

@section('content')
<?php setlocale(LC_MONETARY, 'fil_PH') ?>

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            @include('layouts.sidebar')

            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">Room Categories</div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <a href="{{ route('create_reservation') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Room Category</a>
                    </div>

                    <br>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @foreach($categories as $category)
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="{{ $category->file_location }}" alt="...">
                                            <div class="caption">
                                                <p>{{ $category->description }}</p>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6 col-md-8">
                                        <form class="form-horizontal">
                                            <div class="form-group ">
                                                <label for="inputCategory" class="col-sm-3 control-label">Category:</label>
                                                <div class="col-sm-8 ">
                                                     <input type="name" class="form-control" id="inputCategory" placeholder="Category Name" value="{{ $category->name }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputNumberOfRooms" class="col-sm-3 control-label">No. of Rooms:</label>
                                                <div class="col-sm-8 ">
                                                    <input class="form-control" id="inputNumberOfRooms" placeholder="Number of Available Rooms" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputMinCapacity" class="col-sm-3 control-label">Min. Capacity:</label>
                                                <div class="col-sm-8 ">
                                                    <input class="form-control" id="inputMinCapacity" placeholder="Minimum Capacity" value="{{ $category->min_capacity }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputMaxCapacity" class="col-sm-3 control-label">Max Capacity:</label>
                                                <div class="col-sm-8 ">
                                                    <input class="form-control" id="inputMaxCapacity" placeholder="Maximum Capacity" value="{{ $category->max_capacity }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="inputPrice" placeholder="Price per Room" value="{{ money_format('%n', $category->price) }}" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-10">
                                                    <a type="submit" class="btn btn-primary btn-sm">Update</a>
                                                    <a href="{{ route('show_room', $category->id) }}" class="btn btn-primary btn-sm">View</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop