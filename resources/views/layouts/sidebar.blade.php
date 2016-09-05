<div class="col-lg-3 col-lg-push-0-2">
    <div class="row">
        <div class="list-group">
            <a href="{{ route('dashboard') }}" class="list-group-item {{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;Dashboard</a>
            <a href="{{ route('reservations') }}" class="list-group-item {{ Request::route()->getName() == 'reservations' ? 'active' : '' }}"><i class="fa fa-book"></i>&nbsp;&nbsp;Reservations</a>
            <a href="{{ route('room_category_index') }}" class="list-group-item {{ Request::route()->getName() == 'room_category_index' ? 'active' : '' }}"><i class="fa fa-list"></i>&nbsp;&nbsp;Room Categories</a>
            <a href="#" class="list-group-item"><i class="fa fa-flag"></i>&nbsp;&nbsp;Pools</a>
            <a href="#" class="list-group-item"><i class="fa fa-diamond"></i>&nbsp;&nbsp;Amenities</a>
            <a href="#" class="list-group-item"><i class="fa fa-money"></i>&nbsp;&nbsp;Entrance Fees</a>
            <a href="#" class="list-group-item"><i class="fa fa-users"></i>&nbsp;&nbsp;Users</a>
            <a href="#" class="list-group-item"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;Reports</a>
        </div>
    </div>
</div>