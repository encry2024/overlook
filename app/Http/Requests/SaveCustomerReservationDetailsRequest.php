<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCustomerReservationDetailsRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required',
            'no_of_adult' => 'required|numeric',
            'no_of_child' => 'required|numeric',
            'period' => 'required',
            'rooms' => 'required',
            'contact' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please provide Customer\'s First Name',
            'last_name.required' => 'Please provide Customer\'s Last Name',
            'email.required' => 'Please provide Customer\'s E-mail',
            'address.required' => 'Please provide Customer\'s Address',
            'no_of_adult.required' => 'Please enter Number of Adult(s) (Put 0 if no adult(s))',
            'no_of_child.required' => 'Please enter Number of Child(ren) (Put 0 if no child(ren))',
            'period.required' => 'Please choose type of Package',
            'rooms.required' => 'You have to choose Rooms for the Customer',
            'contact.required' => 'Please provide Customer\'s Contact Number',
            'address.required' => 'Please provide Customer\'s Address'
        ];
    }
}
