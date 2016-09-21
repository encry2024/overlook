<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'contact'       => 'min:7|max:11',
            'email'         => 'required|email',
            'start_date'    => 'required',
            'rooms'         => 'required',
            'no_of_child'   => 'required|max:50|numeric',
            'no_of_adult'   => 'required|max:100|numeric',
            'period'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'    => 'Customer\'s First Name is required',
            'last_name.required'     => 'Customer\'s Last Name is required',
            'contact.min'            => 'Minimum contact number is 7 digits (Home number)',
            'contact.max'            => 'Minimum contact number is 11 digits (mobile number)',
            'start_date.required'    => 'Date of Reservation is required',
            'rooms.required'         => 'You need to select a room to process your reservation'
        ];
    }
}
