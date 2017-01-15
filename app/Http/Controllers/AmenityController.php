<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Amenity;
use App\Reservation;

class AmenityController extends Controller
{
    //
    public function index()
    {
        $ctr = 0;
        $amenities = Amenity::paginate(25);
        $amenities->setPath('/amenities');

        return view('amenity.index', compact('amenities', 'ctr'));
    }

    public function showAmenity(Amenity $amenity)
    {
        return view('amenity.show', compact('amenity'));
    }

    public function createAmenity()
    {
        return view('amenity.create');
    }

    public function postAmenity(CreateAmenityRequest $createAmenityRequest)
    {
        $postAmenity = Amenity::postAmenity($createAmenityRequest);

        return $postAmenity;
    }

    public function editAmenity(Amenity $amenity)
    {
        return view('amenity.edit', compact('amenity'));
    }

    public function updateAmenity(UpdateAmenityRequest $updateAmenityRequest)
    {
        $updateAmenity = Amenity::updateAmenity($updateAmenityRequest);

        return $updateAmenity;
    }

    public function deleteAmenity(Amenity $amenity)
    {
        if($amenity->delete()) {
            return redirect()->route('amenity_index')->with('message', 'You have successfully deleted amenity ' . $amenity->name);
        }
    }

    public function makeOrder()
    {
        $ctr = 0;
        $reservations = Reservation::simplePaginate(50);
        $reservations->setPath('/reservations');

        return view('amenity.order', compact('reservations', 'ctr'));
    }

    public function customerAddAmenity(Reservation $reservation)
    {
        $ctr = 0;
        $amenities = Amenity::where('quantity', '!=', 0)->simplePaginate(30);
        $amenities->setPath('/amenity/customer/1/order/amenities');

        return view('amenity.create_order', compact('reservation', 'ctr', 'amenities'));
    }

    public function purchaseAmenity(Request $request, Reservation $reservation)
    {
        $reservation_id = $reservation->id;
        $customerPurchaseAmenity = Amenity::purchaseAmenity($request, $reservation_id);

        return $customerPurchaseAmenity;
    }
}
