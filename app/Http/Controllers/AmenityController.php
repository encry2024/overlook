<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use App\Amenity;

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
}
