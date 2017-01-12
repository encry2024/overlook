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
        <div class="col-lg-3">
            <div class="list-group">
                <a href="#create_user" class="list-group-item list-group-item-success"
                onclick="document.getElementById('PostUserForm').submit();"><i class="fa fa-check"></i>&nbsp;&nbsp;Create User</a>
                <a href="{{ route('user_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 20px;">
                         <i class="fa fa-plus"></i>&nbsp;&nbsp;CREATE USER
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="panel panel-default" style="border-top-left-radius: 0px;">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <form class="form-horizontal" action="{{ route('post_create') }}" method="POST" id="PostUserForm">
                                        {{ csrf_field() }}

                                        <div class="form-group ">
                                            <label for="inputUser" class="col-sm-3 control-label">Name:</label>
                                            <div class="col-sm-8 ">
                                                <input name="name" class="form-control" id="inputUser" placeholder="Name" value="{{ old('name') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-3 control-label">E-mail:</label>
                                            <div class="col-sm-8 ">
                                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-3 control-label">Password:</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" value="{{ old('password') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPasswordConfirmation" class="col-sm-3 control-label">Confirm Password:</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputRole" class="col-sm-3 control-label">Role:</label>
                                            <div class="col-sm-8">
                                                <select name="role" id="inputRole" class="form-control">
                                                    <option value="customer">Customer</option>
                                                    <option value="employee">Employee</option>
                                                </select>
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