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
                        <div class="panel-heading" style="font-size: 20px;">POOL CATEGORIES</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                 <div class="row">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create Pool Category</a>
                </div>

                <br>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @foreach($pools as $pool)
                            <div class="col-lg-12">
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ $pool->file_location }}" alt="...">
                                        <div class="caption">
                                            <p>{{ $pool->description }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <form class="form-horizontal">
                                        <div class="form-group ">
                                            <label for="inputPool" class="col-sm-3 control-label">Pool Name:</label>
                                            <div class="col-sm-8 ">
                                                 <input type="name" class="form-control" id="inputPool" placeholder="Pool Name" value="{{ $pool->name }}" disabled>
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
                                            <label for="inputPrice" class="col-sm-3 control-label">Price per Head:</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="inputPrice" placeholder="Price per Room" value="{{ money_format('%n', $pool->price) }}" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <a type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatePool"
                                                onclick="editPool({{ $pool->id }}, '{{ $pool->file_location }}', '{{ $pool->name }}', {{ $pool->min_capacity }} ,{{ $pool->max_capacity }}, {{ $pool->price  }}, '{{ $pool->description }}')">Update</a>
                                                <a href="{{ route('show_pool', $pool->id) }}" class="btn btn-primary btn-sm">View</a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="updatePool">
    <form class="form-horizontal" action="" method="POST" id="update_form" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" id="pool_id" name="pool_id">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="pool_title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="inputPool" class="col-sm-4 control-label">Pool Name:</label>
                        <div class="col-sm-8 ">
                             <input name="name" class="form-control" id="pool_name" placeholder="Pool Name" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputMinCapacity" class="col-sm-4 control-label">Min. Capacity:</label>
                        <div class="col-sm-8 ">
                            <input name="min_capacity" class="form-control" id="min_capacity" placeholder="Minimum Capacity" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputMaxCapacity" class="col-sm-4 control-label">Max Capacity:</label>
                        <div class="col-sm-8 ">
                            <input name="max_capacity" class="form-control" id="max_capacity" placeholder="Maximum Capacity" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPrice" class="col-sm-4 control-label">Price per Head:</label>
                        <div class="col-sm-8">
                            <input name="price" class="form-control" id="pool_price" placeholder="Price per Room" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-4 control-label">Pool Description:</label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="fileToUpload" class="col-sm-4 control-label">Upload Pool Image:</label>
                        <div class="col-sm-8 ">
                             <input type="file" name="fileToUpload" accept="image/*.{jpg,png}" class="form-control" id="fileToUpload">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update Pool</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<script>
    function editPool(pool_id, pool_file_location, pool_name, min_capacity, max_capacity, price, description) {
            var url = "{{ route('pool_update', ':pool_id') }}"
            url = url.replace(':pool_id', pool_id);

            document.getElementById('pool_title').innerHTML = pool_name;
            document.getElementById('pool_name').value = pool_name;
            document.getElementById('min_capacity').value = min_capacity;
            document.getElementById('max_capacity').value = max_capacity;
            document.getElementById('pool_price').value = price;
            document.getElementById('description').value = description;
            document.getElementById('update_form').action = url;
            document.getElementById('pool_id').value = pool_id;
        }
</script>
@stop