<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reservation;
use App\Entrance;
use App\Http\Requests\CreateReservationRequest;
use App\ReservationRoom;
use DB;
use App\Room;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $ctr = 0;
        $reservations = Reservation::latest()->paginate(20);

        $reservations->setPath('/reservations');

        return view('reservation.index', compact('reservations', 'ctr'));
    }

    public function create()
    {
        return view('reservation.create');
    }

    public function createReservation($reservation_date)
    {
        $create_reservation = Reservation::createCustomerReservation($reservation_date);

        return $create_reservation;
    }

    public function saveCustomerReservationDetails(Request $data)
    {
        $store_customer_reservation = Reservation::saveCustomerReservationDetails($data);

        return $store_customer_reservation;
    }

    public function getReservationJson()
    {
        $get_reservation_json = Reservation::getReservationJson();

        return $get_reservation_json;
    }

    public function fetchReservedRooms()
    {
        $fetch_reserved_rooms = Reservation::fetchReservedRooms();

        return $fetch_reserved_rooms;
    }
}
