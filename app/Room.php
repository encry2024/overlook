<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_room');
    }

    public function reservation_room()
    {
        return $this->hasMany(ReservationRoom::class);
    }
    
    public static function postCreate($request, $category)
    {
        foreach((array) $request->get('name') as $room) {
            $new_room = new Room();
            $new_room->category_id = $category->id;
            $new_room->name = $room;
            $new_room->save();
        }

        return redirect()->back()->with('message', 'Room was successfully created.');
    }

    public static function getRooms($q)
    {
        $json = array();
        $categories = Category::with(['rooms' => function($query) use ($q) {
            $query->where('name', 'LIKE', '%'.$q.'%');
        }])->get();

        foreach($categories as $category) {
            foreach($category->rooms as $room) {
                $json[] = [
                    'category_id' => $category->id,
                    'room_id' => $room->id,
                    'category_name' => $category->name,
                    'room_name' => $room->name,
                    'category_min' => $category->min_capacity,
                    'category_max' => $category->max_capacity,
                    'category_price' => $category->price
                ];
            }
        }

        return $json;
    }
}
