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
@if (count($errors) > 0)
<div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible">
        <i class="close icon"></i>
        <div class="header">
            User was not able to create because of the following reason(s)
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
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
                <a href="#update_user" class="list-group-item list-group-item-success" data-toggle="modal" data-target="#UpdateUserModal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Update User</a>
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
                            <form action="{{ route('update_user', $user->id) }}" class="form-horizontal" method="POST" id="UpdateUserForm">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Front Desk Agent Name: </label>
                                    <div class="col-lg-7">
                                        <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">E-mail: </label>
                                    <div class="col-lg-7">
                                        <input name="email" type="text" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Password: </label>
                                    <div class="col-lg-7">
                                        <input name="password" type="password" class="form-control" placeholder="">
                                        <p class="help-block"><i>Leave password blank if you do not want to change your password</i></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Confirm Password: </label>
                                    <div class="col-lg-7">
                                        <input name="password_confirmation" type="password" class="form-control">
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

<div class="modal fade" id="UpdateUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update User</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to update {{ $user->name }}'s Information
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('UpdateUserForm').submit();">Update User</button>
            </div>
        </div>
    </div>
</div>
@stop