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
});