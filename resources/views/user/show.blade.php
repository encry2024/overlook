@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="col-lg-12">
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="container"><i class="fa fa-check"></i>&nbsp;&nbsp;{{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
    </div>
</div>
@endif
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
                <a href="{{ route('edit_user', $user->id) }}" class="list-group-item"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a>
                <a href="#" class="list-group-item list-group-item-danger" data-toggle="modal" data-target="#DeleteUser"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete this user</a>
                <a href="{{ route('user_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">{{ $user->name }}</div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Front Desk Agent Name: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">E-mail: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User Role: </label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" value="{{ ucwords($user->role, '-') }}" disabled>
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

<div class="modal fade" tabindex="-1" role="dialog" id="DeleteUser">
    <form class="form-horizontal" action="{{ route('delete_user', $user->id) }}" id="delete_user_form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="user_title">Delete <b>{{ $user->name }}</b></h4>
                </div>
                <div class="modal-body">
                    <label for="">Are you sure you want to delete user <code>{{ $user->name }}</code></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete User</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
@stop