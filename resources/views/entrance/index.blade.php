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
                        <div class="panel-heading" style="font-size: 20px;">ENTRANCE PACKAGES/RATES & TYPES</div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                @foreach($entrances as $entrance)
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">{{ strtoupper($entrance->name) }}</div>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Entrance Type</th>
                                                    <th>Entrance Rates</th>
                                                </thead>
                                                <tbody>
                                                @foreach($entrance->entrance_type as $entrance_type)
                                                    <tr>
                                                        <td>{{ $entrance_type->name }}</td>
                                                        <td>
                                                            @foreach($entrance_type->entrance_rates as $entrance_rate)
                                                                {{ $entrance_rate->name }} <b>[Rate: {{ number_format($entrance_rate->price, 2) }}]</b>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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