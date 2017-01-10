<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['item', 'price', 'quantity', 'expiration_date'];

    public static function postAmenity($createAmenityRequest)
    {
        $amenity = new Amenity();
        $amenity->item = ucwords($createAmenityRequest->get('item'), ' ');
        $amenity->quantity = $createAmenityRequest->get('quantity');
        $amenity->price = $createAmenityRequest->get('price');
        $amenity->expiration_date = date('Y-m-d', strtotime($createAmenityRequest->get('expiration_date')));

        if($amenity->save()) {
            return redirect()->back()->with('message', $amenity->item. ' was successfully created');
        }
    }

    public static function updateAmenity($updateAmenityRequest)
    {
        $amenity = Amenity::find($updateAmenityRequest->get('amenity_id'));
        $amenity->update([
            'item' => $updateAmenityRequest->get('item'),
            'quantity' => $updateAmenityRequest->get('quantity'),
            'price' => $updateAmenityRequest->get('price'),
            'expiration_date' => date('Y-m-d', strtotime($updateAmenityRequest->get('expiration_date')))
        ]);

        $message = 'Amenity: ' . $amenity->name . ' was successfully updated';
        $alert_icon = 'check';
        $alert_type = 'success';

        return redirect()->back()->with('message', $message)->with('alert_icon', $alert_icon)->with('alert_type', $alert_type);
    }
}
