
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/homepage');
});

Auth::routes();

Route::get('/homepage', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    # RESERVATIONS
    Route::get('/reservations', 'ReservationController@index')->name('reservations');
    Route::get('/reservations/create', 'ReservationController@create')->name('create_reservation');
    Route::group(['prefix' => 'reservation'], function() {
        Route::get('/{reservation}/details', 'ReservationController@show')->name('show_reservation');
        Route::get('/{reservation}/edit', 'ReservationController@edit')->name('edit_reservation');
        Route::patch('/{reservation}/update', 'ReservationController@update')->name('update_reservation');
        Route::get('/{reservation}/check-in', 'ReservationController@checkInReservation')->name('checkin_reservation');
        Route::patch('/{reservation}/cancel', 'ReservationController@cancelReservation')->name('cancel_reservation');
        Route::patch('/{reservation}/reopen', 'ReservationController@reopenReservation')->name('reopen_reservation');
        Route::get('/{reservation}/check-out', 'ReservationController@checkOutReservation')->name('checkout_reservation');
        Route::patch('/{reservation}/checkout', 'ReservationController@checkOutCustomer')->name('checkout_customer');
    });

    # ROOMS
    Route::get('categories', 'CategoryController@index')->name('room_category_index');
    Route::get('category/{category}', 'CategoryController@show')->name('show_room');
    Route::get('category/{category}/create', 'CategoryController@create')->name('create_room');
    Route::post('category/{category}/create', 'CategoryController@postCreate')->name('post_room');
    Route::get('category/{category}/rooms', 'CategoryController@showRooms')->name('rooms');
    Route::get('category/{category}/room/create', 'CategoryController@createRoom')->name('create_room');
    Route::get('/category/{room}/reserved', 'ReservationController@showReservedRoom')->name('show_reserved_room');
    Route::patch('/category/{category}/update', 'CategoryController@updateCategory')->name('update_category');
    Route::get('/category/{category}/edit', 'CategoryController@editCategory')->name('edit_category');
    Route::delete('/category/{category}/delete', 'CategoryController@deleteCategory')->name('delete_category');

    # CUSTOMER
    Route::get('/customer/{customer}/billing', 'CustomerController@showCustomerBilling')->name('show_customer_billing');

    # POOLS
    Route::get('/pools', 'PoolController@index')->name('pool_index');
    Route::group(['prefix' => 'pool'], function() {
        Route::patch('/{pool}/update', 'PoolController@updatePool')->name('pool_update');
        Route::get('/{pool}', 'PoolController@showPool')->name('show_pool');
        Route::get('/{pool}/edit', 'PoolController@editPool')->name('edit_pool');
        Route::delete('/{pool}/delete', 'PoolController@deletePool')->name('delete_pool');
    });

    # AMENITIES
    Route::get('/amenities', 'AmenityController@index')->name('amenity_index');
    Route::group(['prefix' => 'amenity'], function() {
        Route::get('/create', 'AmenityController@createAmenity')->name('create_amenity');
        Route::post('/create', 'AmenityController@postAmenity')->name('post_amenity');
        Route::get('/make-order/', 'AmenityController@makeOrder')->name('make_order');
        Route::get('/customer/{reservation}/order/amenity', 'AmenityController@customerAddAmenity')->name('add_amenity');
        Route::get('/{amenity}', 'AmenityController@showAmenity')->name('show_amenity');
        Route::get('/{amenity}/edit', 'AmenityController@editAmenity')->name('edit_amenity');
        Route::patch('/{amenity}/update', 'AmenityController@updateAmenity')->name('update_amenity');
        Route::delete('/{amenity}/delete', 'AmenityController@deleteAmenity')->name('delete_amenity');
        Route::post('/{reservation}/purchase_amenity', 'AmenityController@purchaseAmenity')->name('purchase_amenity');
    });

    # USERS
    Route::get('/users', 'UserController@index')->name('user_index');
    Route::group(['prefix' => 'user'], function() {
        Route::get('/create', 'UserController@create')->name('create_user');
        Route::get('/{user}/profile', 'UserController@show')->name('show_user');
        Route::post('/create', 'UserController@store')->name('post_create');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit_user');
        Route::patch('/{user}/update', 'UserController@update')->name('update_user');
        Route::delete('/{user}/delete', 'UserController@delete')->name('delete_user');
    });

    # ENTRANCE
    Route::get('/entrance_packages', 'EntranceController@index')->name('entrance_package_index');
    Route::group(['prefix' => 'entrance'], function() {
        Route::get('/create', 'EntranceController@create')->name('create_package_create');
        Route::post('/store', 'EntranceController@store')->name('store_package');
        Route::get('/package/{entrance}/', 'EntranceController@show')->name('show_package');
        Route::get('/package/{entrance}/edit', 'EntranceController@edit')->name('edit_package');
        Route::patch('/package/{entrance}/update', 'EntranceController@update')->name('update_package');
        Route::delete('/package/{entrance}/delete', 'EntranceController@destroy')->name('delete_package');
    });

    /*
     * JSON REQUESTS
     * This section is for JSON requests only
     * */
    Route::get('/getRooms/{query}', 'RoomController@getRooms')->name('get_rooms');
    Route::get('create_reservation/{reservation_date}', 'ReservationController@createReservation')->name('reservation_date');
    Route::post('/save/customer_reservation', 'ReservationController@saveCustomerReservationDetails')->name('save_customer_reservation_details');
    Route::get('fetch_reserved_rooms', 'ReservationController@fetchReservedRooms')->name('dashboardFetchReservedRooms');
    Route::get('getReservations', 'ReservationController@getReservationJson')->name('reserved_rooms');
});