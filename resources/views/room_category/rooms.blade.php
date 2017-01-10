@extends('layouts.app')


@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3">
            <div class="list-group">
                <a href="{{ route('create_room', $category->id) }}" class="list-group-item"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Room</a>
                <a href="#" class="list-group-item"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                <a href="#" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload New Picture</a>
                <a href="#" class="list-group-item list-group-item-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete this Category</a>
                <a href="{{ route('room_category_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        <img src="{{ $category->file_location }}" alt="" style="width: 10%;">&nbsp;&nbsp;{{ $category->name }} Category
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="{{ route('show_room', $category->id) }}" >Information</a></li>
                        <li role="presentation" class="active"><a href="{{ route('rooms', $category->id) }}">Rooms</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Room Name</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach($category->rooms as $room)
                                        <tr>
                                            <td>{{ $room->id }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop