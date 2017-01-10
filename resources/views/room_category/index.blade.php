@extends('layouts.app')

@section('content')
<?php setlocale(LC_MONETARY, 'fil_PH') ?>
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
        @include('layouts.sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">ROOM CATEGORIES</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <a href="{{ route('create_reservation') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Room Category</a>
                </div>

                <br>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @foreach($categories as $category)
                            <div class="col-lg-12">
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ $category->file_location != '' ? $category->file_location : URL::to('/') . '/pictures/image_null/image-not-available.png' }}" alt="...">
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
                                                <a class="btn btn-primary btn-sm"
                                                data-target="#updateCategory"
                                                data-toggle="modal"
                                                onclick="editCategory({{ $category->id }}, '{{ $category->file_location }}', '{{ $category->name }}', {{ $category->min_capacity }} ,{{ $category->max_capacity }}, {{ $category->price }}, '{{ $category->description }}');"
                                                >Update</a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="updateCategory">
    <form class="form-horizontal" action="" id="update_form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="category_id" id="category_id">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category_title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="inputcategory" class="col-sm-4 control-label">Category Name:</label>
                        <div class="col-sm-8 ">
                             <input name="name" class="form-control" id="categoryName" placeholder="Category Name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputMinCapacity" class="col-sm-4 control-label">Min. Capacity:</label>
                        <div class="col-sm-8 ">
                            <input name="min_capacity" class="form-control" id="minCapacity" placeholder="Minimum Capacity" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputMaxCapacity" class="col-sm-4 control-label">Max Capacity:</label>
                        <div class="col-sm-8 ">
                            <input name="max_capacity" class="form-control" id="maxCapacity" placeholder="Maximum Capacity" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPrice" class="col-sm-4 control-label">Price per Head:</label>
                        <div class="col-sm-8">
                            <input name="price" class="form-control" id="categoryPrice" placeholder="Price per Room" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-4 control-label">Category Description:</label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control" id="categoryDescription" value=""></textarea>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="fileToUpload" class="col-sm-4 control-label">Upload category Image:</label>
                        <div class="col-sm-8 ">
                             <input type="file" name="fileToUpload" accept="image/*.{jpg,png,jpeg}" class="form-control" id="fileToUpload" title=" test">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update Category</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<script>
    function editCategory(category_id, category_file_location, category_name, min_capacity, max_capacity, price, description)
    {
        var url = "{{ route('update_category', ':category_id') }}"
        url = url.replace(':category_id', category_id);

        document.getElementById('category_title').innerHTML = category_name;
        document.getElementById('categoryName').value = category_name;
        document.getElementById('minCapacity').value = min_capacity;
        document.getElementById('maxCapacity').value = max_capacity;
        document.getElementById('categoryPrice').value = price;
        document.getElementById('categoryDescription').value = description;
        document.getElementById('update_form').action = url;
        document.getElementById('category_id').value = category_id;
    }
</script>
@stop