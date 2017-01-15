<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reservation;
use App\Entrance;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\SaveCustomerReservationDetailsRequest;
use App\ReservationRoom;
use DB;
use App\Room;
use App\Discount;
use App\AmenityReservation;
use App\DiscountReservation;
use App\BillingReservation;

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

    public function show(Reservation $reservation)
    {
        $discountReservation = '';
        $purchased_amenities = AmenityReservation::whereReservationId($reservation->id)->get();
        $discount_reservation = DiscountReservation::where('reservation_id', $reservation->id)->first();

        if(count($discount_reservation) == 0) {
            $discountReservation = "NO-DISCOUNT";
        }

        return view('reservation.show', compact('reservation', 'purchased_amenities', 'discount_reservation', 'discountReservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservation.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $updateReservation = Reservation::updateReservation($request, $reservation);

        return $updateReservation;
    }

    public function createReservation($reservation_date)
    {
        $create_reservation = Reservation::createCustomerReservation($reservation_date);

        return $create_reservation;
    }

    public function saveCustomerReservationDetails(Request $data, SaveCustomerReservationDetailsRequest $saveCustomerReservationDetailsRequest)
    {
        $store_customer_reservation = Reservation::saveCustomerReservationDetails($data, $saveCustomerReservationDetailsRequest);

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

    public function checkInReservation(Reservation $reservation)
    {
        $discounts = Discount::all();
        return view('reservation.checkin', compact('reservation', 'discounts'));
    }

    public function cancelReservation(Reservation $reservation)
    {
        $reservation->update(['status' => 'CANCELLED']);

        return redirect()->back()->with('message', 'Reservation ' . $reservation->reference_number . ' has been cancelled');
    }

    public function reopenReservation(Reservation $reservation)
    {
        $reservation->update(['status' => 'RESERVED']);

        return redirect()->back()->with('message', 'Reservation ' . $reservation->reference_number . ' has been Reopened');
    }

    public function checkOutReservation(Reservation $reservation)
    {
        $discountReservation = '';
        $purchased_amenities = AmenityReservation::whereReservationId($reservation->id)->get();
        $discount_reservation = DiscountReservation::where('reservation_id', $reservation->id)->first();

        if(count($discount_reservation) == 0) {
            $discountReservation = "NO-DISCOUNT";
        } else {
            $discountReservation = "WITH-DISCOUNT";
        }

        return view('reservation.checkout', compact('reservation', 'purchased_amenities', 'discount_reservation', 'discountReservation'));
    }

    public function checkOutCustomer(Request $request, Reservation $reservation)
    {
        $billingReservation = BillingReservation::whereReservationId($reservation->id)->first();
        $billingReservation->update(['total_cost' => $request->get('overall_payment')]);
        $reservation->update(['status' => 'CHECKED-OUT']);

        return redirect()->back()->with('message', 'Customer was successfully Checked-Out')->with('alertType', 'success')->with('alertIcon', 'check');
    }
}
