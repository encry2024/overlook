<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Entrance;
use App\Customer;
use App\Category;
use Mail;

class Reservation extends Model
{
    //

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function room()
    {
        return $this->belongsToMany(Room::class, 'reservation_room');
    }

    public function reservation_room()
    {
        return $this->hasMany(ReservationRoom::class)->orderBy('date_reserved');
    }

    public function getReservationId()
    {
        $character_set_array   = array();
        $character_set_array[] = array('count' => 7, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $character_set_array[] = array('count' => 1, 'characters' => '0123456789');
        $temp_array            = array();

        foreach ($character_set_array as $character_set) {
            for ($i = 0; $i < $character_set['count']; $i++) {
                $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
            }
        }

        shuffle($temp_array);
        return implode('', $temp_array);
    }

    public static function createCustomerReservation($reservation_date)
    {
        $packages = Entrance::all();

        $dates = explode('&', $reservation_date);
        $start_date = $dates[0];
        $end_date   = $dates[1];

        $entrances      = Entrance::with(['entrance_type'])->get();

        $room_ids = DB::table('rooms')
            ->join('reservation_room', function ($join)  {
                $join->on('rooms.id', '=', 'reservation_room.room_id');
            })
            ->where('reservation_room.date_reserved', '=' , $start_date)
            ->where('reservation_room.date_reserved', '<' , $end_date)
            ->pluck('reservation_room.room_id')->groupBy('rooms.id');

        # Fetch all the room that is not equal to the given id's
        $categories = Category::with(['rooms' => function ($query) use ($room_ids) {
            $query->whereNotIn('id', $room_ids);
        }])->get();

        return view('reservation.form', compact('start_date', 'end_date', 'categories', 'entrances', 'packages'));
    }

    public static function saveCustomerReservationDetails($data)
    {

        //dd($data->all());
        $getReferenceNumber = new Reservation();
        $rooms              = explode(',', $data->get('rooms'));
        $customer           = Customer::whereEmail($data->get('email'))->first();
        $total_capacity     = 0;
        $total_person       = $data->get('no_of_adult') + $data->get('no_of_child');

        foreach ((array) $rooms as $rm) {
            $rms = Room::find($rm);

            $categories = Category::find($rms->category_id);

            if (count($categories) > 0) {
                $total_capacity += $categories->max_capacity;
            }
        }

        if ($total_capacity < $total_person) {
            return redirect()->back()->with('message', 'You exceeded the max capacity of the rooms');
        } else {
            if (count($customer) == 0) {
                $customer = new Customer();
                $customer->name = ucfirst(strtolower($data->get('first_name'))) . ' ' . ucfirst(strtolower($data->get('last_name')));
                $customer->address = $data->get('address');
                $customer->email = $data->get('email');
                $customer->contact_number = $data->get('contact');

                if ($customer->save()) {
                    $reservation = new Reservation();
                    $reservation->customer_id = $customer->id;
                    $reservation->reference_number = $getReferenceNumber->getReservationId();
                    $reservation->no_of_child = $data->get('no_of_child');
                    $reservation->no_of_adult = $data->get('no_of_adult');
                    $reservation->period = $data->get('period');
                    $reservation->status = 'RESERVED';

                    if ($reservation->save()) {
                        foreach ((array)$rooms as $room) {
                            $start_date = $data->get('start_date');
                            $end_date = $data->get('end_date');

                            # ROOM VISITOR
                            $start_date = date("Y-m-d", strtotime($start_date));

                            while (strtotime($start_date) < strtotime($end_date)) {
                                $reservation_room = new ReservationRoom();
                                $reservation_room->reservation_id = $reservation->id;
                                $reservation_room->room_id = $room;
                                $reservation_room->date_reserved = $start_date;
                                $reservation_room->save();

                                $start_date = date("Y-m-d", strtotime("+1 day", strtotime($start_date)));
                            }

                        }
                    }
                }

                Mail::send('emails.reservation_reference', ['customer' => $customer, 'reservation' => $reservation], function ($m) use ($customer) {
                    $m->from('noreply@overlook-resort.com', 'Overlook Resort (noreply)');

                    $m->to($customer->email, $customer->full_name())->subject('Here\'s your RESERVATION ID');
                });

                return redirect()->back()->with('message', 'Reservation was successful. We sent your reservation reference in your e-mail');
            }

            $reservation                   = new Reservation();
            $reservation->customer_id      = $customer->id;
            $reservation->reference_number = $reservation->getReservationId();
            $reservation->no_of_child      = $data->get('no_of_child');
            $reservation->no_of_adult      = $data->get('no_of_adult');
            $reservation->period           = $data->get('period');
            $reservation->status           = 'Not Paid';

            if ($reservation->save()) {
                foreach ((array) $rooms as $room) {
                    $start_date = $data->get('start_date');
                    $end_date = $data->get('end_date');

                    # ROOM VISITOR
                    $start_date = date("Y-m-d", strtotime($start_date));

                    while (strtotime($start_date) < strtotime($end_date)) {
                        $reservation_room = new ReservationRoom();
                        $reservation_room->reservation_id = $reservation->id;
                        $reservation_room->room_id = $room;
                        $reservation_room->date_reserved = $start_date;
                        $reservation_room->save();

                        $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
                    }

                }
            }

            Mail::send('emails.reservation_reference', ['customer' => $customer, 'reservation' => $reservation], function ($m) use ($customer) {
                $m->from('noreply@overlook-resort.com', 'Overlook Resort (noreply)');

                $m->to($customer->email, $customer->full_name())->subject('Here\'s your RESERVATION ID');
            });

            return redirect()->back()->with('message', 'Reservation was successful. We sent your reservation reference in your e-mail');

        }
    }

    /*
     * RESERVATION json
     */

    public static function getReservationJson()
    {
        $json = array();
        $reservations = Reservation::with(['room', 'reservation_room' => function($query) {
            $query->where('date_reserved', '>=', date('Y-m-d'))
                ->where('status', '=', 'PAID');
        }])->get();

        foreach ($reservations as $reservation) {
            foreach ($reservation->reservation_room as $reservation_rooms) {
                $json[] = array(
                    'title' => $reservation_rooms->room->category->name . ' - ' . $reservation_rooms->room->name,
                    'start' => $reservation_rooms->date_reserved
                );
            }
        }

        return json_encode($json);
    }

    public static function fetchReservedRooms()
    {
        $json = array();
        $reservations = Reservation::with(['room', 'reservation_room' => function($query) {
            $query->where('date_reserved', '>=', date('Y-m-d'));
        }])->get();

        foreach ($reservations as $reservation) {
            foreach ($reservation->reservation_room as $reservation_rooms) {
                $json[] = array(
                    'title' => $reservation->reference_number . ' - ' . $reservation_rooms->room->category->name . ' - ' . $reservation_rooms->room->name,
                    'start' => $reservation_rooms->date_reserved,
                    'url' => route('show_reserved_room', $reservation_rooms->id)
                );
            }
        }

        return json_encode($json);
    }
}
