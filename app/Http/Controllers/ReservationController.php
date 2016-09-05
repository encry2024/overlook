<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reservation;
use App\Entrance;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $ctr = 0;
        $reservations = Reservation::latest()->paginate(25);
        $reservations->setPath('reservations');

        return view('reservation.index', compact('reservations', 'ctr'));
    }

    public function create()
    {
        $packages = Entrance::all();

        return view('reservation.create', compact('packages'));
    }
}
