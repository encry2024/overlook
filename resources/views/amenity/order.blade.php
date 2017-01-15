@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="list-group">
                <a href="{{ route('amenity_index') }}" class="list-group-item"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
            </div>
        </div>
        <div class="co-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">CUSTOMERS</div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>#</th>
                                            <th>Reservation Reference</th>
                                            <th>Customer Name</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($reservations as $reservation)
                                            <tr>
                                                <td>{{ ((($reservations->currentPage() - 1) * $reservations->perPage()) + ($ctr++) + 1) }}</td>
                                                <td>{{ $reservation->reference_number }}</td>
                                                <td>{{ $reservation->customer->name }}</td>
                                                <td><a href="{{ route('add_amenity', $reservation->id) }}" class="btn btn-sm btm-success"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Amenity</a></td>
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
</div>
@stop