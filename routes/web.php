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

    Route::get('/reservations', 'ReservationController@index')->name('reservations');
    Route::get('/reservations/create', 'ReservationController@create')->name('create_reservation');

    Route::get('/room_categories', 'CategoryController@index')->name('room_category_index');
    Route::get('/room_categories/{category}', 'CategoryController@show')->name('show_room');
    Route::get('/room_categories/{category}/create', 'CategoryController@create')->name('create_room');
    Route::post('/room_categories/{category}/create', 'CategoryController@postCreate')->name('post_room');
    Route::get('/room_categories/{category}/rooms', 'CategoryController@showRooms')->name('rooms');
    Route::get('/room_categories/{category}/room/create', 'CategoryController@createRoom')->name('create_room');
    Route::get('getReservations', 'ReservationController@getReservationJson')->name('reserved_rooms');

    Route::get('/room/{room}/reserved', 'ReservationController@showReservedRoom')->name('show_reserved_room');

    Route::get('/customer/{customer}/billing', 'CustomerController@showCustomerBilling')->name('show_customer_billing');

    Route::get('/pools', 'PoolController@index')->name('pool_index');
    Route::post('/pool/{pool}/update', 'PoolController@updatePool')->name('pool_update');
    /*
     * JSON REQUESTS
     * This section is for JSON requests only
     * */

    Route::get('/getRooms/{query}', 'RoomController@getRooms')->name('get_rooms');
    Route::get('create_reservation/{reservation_date}', 'ReservationController@createReservation')->name('reservation_date');
    Route::post('/save/customer_reservation', 'ReservationController@saveCustomerReservationDetails')->name('save_customer_reservation_details');
    Route::get('fetch_reserved_rooms', 'ReservationController@fetchReservedRooms')->name('dashboardFetchReservedRooms');
});