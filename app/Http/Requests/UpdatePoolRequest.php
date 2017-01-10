<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePoolRequest extends FormRequest
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
            'name' => 'required|unique:pools,name,'.$this->request->get('pool_id'),
            'min_capacity' => 'required|integer',
            'max_capacity' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'fileToUpload' => 'mimes:jpeg,png,jpg|nullable',
            'pool_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'price.integer' => 'Price must contain only numbers. The system will automatically convert it into currency'
        ];
    }
}
