<div class="col-lg-3 col-md-3 col-sm-3">
    <div class="list-group">
        <a href="{{ route('dashboard') }}" class="list-group-item {{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="{{ route('reservations') }}" class="list-group-item {{ Request::route()->getName() == 'reservations' ? 'active' : '' }}"><i class="fa fa-book"></i>&nbsp;&nbsp;Reservations</a>
        <a href="{{ route('room_category_index') }}" class="list-group-item {{ Request::route()->getName() == 'room_category_index' ? 'active' : '' }}"><i class="fa fa-list"></i>&nbsp;&nbsp;Room Categories</a>
        <a href="{{ route('pool_index') }}" class="list-group-item {{ Request::route()->getName() == 'pool_index' ? 'active' : '' }}"><i class="fa fa-flag"></i>&nbsp;&nbsp;Pools & Cottages</a>
        <a href="{{ route('amenity_index') }}" class="list-group-item {{ Request::route()->getName() == 'amenity_index' ? 'active' : '' }}"><i class="fa fa-diamond"></i>&nbsp;&nbsp;Amenities</a>
        <a href="{{ route('entrance_package_index') }}" class="list-group-item {{ Request::route()->getName() == 'entrance_package_index' ? 'active' : '' }}"><i class="fa fa-money"></i>&nbsp;&nbsp;Entrance Packages/Rates & Types</a>
        <a href="{{ route('user_index') }}" class="list-group-item {{ Request::route()->getName() == 'user_index' ? 'active' : '' }}"><i class="fa fa-users"></i>&nbsp;&nbsp;Customers & Employees</a>
    </div>
</div>