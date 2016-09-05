@extends('layouts.app')


@section('content')
<div class="container">
    <div class="col-lg-12">
        <div class="row">
            @include('layouts.sidebar')
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">RESERVATIONS</div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="row">
                        <a href="{{ route('create_reservation') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Make a Reservation</a>
                    </div>

                    <br>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <th></th>
                                            <th>Resrv. #</th>
                                            <th>Name</th>
                                            <th>Room</th>
                                            <th>Reservation Time</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
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
</div>
@stop