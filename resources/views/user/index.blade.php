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
        @include('layouts.sidebar')
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">USERS</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <a href="{{ route('create_user') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create User</a>
                </div>

                <br>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Role</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ ((($users->currentPage() - 1) * $users->perPage()) + ($ctr++) + 1) }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ date('F d, Y', strtotime($user->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('show_user', $user->id) }}" class="btn btn-primary btn-sm">View User</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {!! $users->appends(['filter' => Request::get('filter')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop