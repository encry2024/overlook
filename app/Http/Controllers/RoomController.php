<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Room;

class RoomController extends Controller
{
    //
    public function getRooms($query)
    {
        $get_rooms = Room::getRooms($query);

        return $get_rooms;
    }
}
