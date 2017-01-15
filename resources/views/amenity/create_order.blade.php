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
                <a href="#purchase_amenity" class="list-group-item" onclick="document.getElementById('PurchaseAmenityForm').submit();">Create Order</a>
                <a href="{{ route('make_order') }}" class="list-group-item">Back</a>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="font-size: 20px;">ADD AMENITY</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-9">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <form action="{{ route('purchase_amenity', $reservation->id) }}" method="POST" id="PurchaseAmenityForm">
                                        {{ csrf_field() }}

                                        <table class="table table-striped">
                                            <thead>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Price (PHP)</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                            </thead>

                                            <tbody>
                                            @foreach($amenities as $amenity)
                                                <tr>
                                                    <td>{{ ((($amenities->currentPage() - 1) * $amenities->perPage()) + ($ctr++) + 1) }}</td>
                                                    <td>{{ $amenity->item }}</td>
                                                    <td>{!! $amenity->quantity == 0 ? '<label class="label label-danger" style="font-size: 13px;">Out of Stock</label>' : $amenity->quantity !!}</td>
                                                    <td>{{ number_format($amenity->price, 2) }}</td>
                                                    <td>{{ date('F d, Y', strtotime($amenity->expiration_date)) }}</td>
                                                    <td>
                                                        @if(date('F d, Y') == date('F d, Y', strtotime($amenity->expiration_date)))
                                                            <label class="label label-danger">EXPIRED</label>
                                                        @else
                                                            <label class="label label-success" style="font-size: 13px;">EDIBLE</label>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('F d, Y', strtotime($amenity->created_at)) }}</td>
                                                    <td>
                                                        <select name="qty[]" id="" class="form-control">
                                                            @for($qty = 1 ; $qty<=$amenity->quantity ; $qty++)
                                                                <option value="{{ $amenity->id }}-{{ $qty }}">{{ $qty }}</div>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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