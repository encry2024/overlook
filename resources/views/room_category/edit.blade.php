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
            Category was not able to update because of the following reason(s)
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
                <a href="#update_category" class="list-group-item list-group-item-success"
                onclick="document.getElementById('UpdateCategoryForm').submit();"><i class="fa fa-check"></i>&nbsp;&nbsp;Update Category</a>
                <a href="#" class="list-group-item"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload New Picture</a>
                <a href="{{ route('room_category_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                        <img src="{{ $category->file_location }}" alt="" style="width: 10%;">&nbsp;&nbsp;Edit {{ $category->name }} Category <i class="fa fa-pencil"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="{{ route('show_room', $category->id) }}" aria-controls="home" role="tab" data-toggle="tab">Information</a></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-horizontal" action="{{ route('update_category', $category->id) }}" method="POST" id="UpdateCategoryForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <input type="hidden" name="category_id" value="{{ $category->id }}">

                                        <div class="form-group ">
                                            <label for="inputCategory" class="col-sm-3 control-label">Name:</label>
                                            <div class="col-sm-8 ">
                                                <input name="name" class="form-control" id="inputCategory" placeholder="Category Name" value="{{ $category->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMinCapacity" class="col-sm-3 control-label">Min. Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="min_capacity" class="form-control" id="inputMinCapacity" placeholder="Minimum Capacity" value="{{ $category->min_capacity }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputMaxCapacity" class="col-sm-3 control-label">Max Capacity:</label>
                                            <div class="col-sm-8 ">
                                                <input name="max_capacity" class="form-control" id="inputMaxCapacity" placeholder="Maximum Capacity" value="{{ $category->max_capacity }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPrice" class="col-sm-3 control-label">Price:</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">PHP</div>
                                                    <input name="price" class="form-control" id="inputPrice" placeholder="Price per Room" value="{{ $category->price }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription" class="col-sm-3 control-label">Description:</label>
                                            <div class="col-sm-8">
                                                <textarea name="description" class="form-control" id="categoryDescription">{{ $category->description }}</textarea>
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
@stop