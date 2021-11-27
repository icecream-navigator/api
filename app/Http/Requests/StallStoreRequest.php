<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StallStoreRequest extends FormRequest
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

            'name'        => 'required|string|between:3,60',
            'photo'       => 'image:jpeg,png,jpg,gif,svg|max:4048',
            'town'        => 'required|string|between:3,60',
            'postal_code' => 'required|string|between:5,60',
            'street'      => 'required|string|between:5,60',
            'open'        => 'required|date_format:H:i',
            'close'       => 'required|date_format:H:i|after:open',
            'place_name'  => 'string|between:3,60',
            'rating'      => 'integer',

        ];
    }

    public function messages()
    {
        return [

            'name.required'        => 'This field is required',
            'name.between'         => 'Must enter 3-60 characters',
            'town.required'        => 'This field is required',
            'postal_code.required' => 'This field is required',
            'street.required'      => 'This field is required',
            'photo.image'          => 'You must provide image with correct format',
            'open.date_format'     => 'Time must be in correct format',
            'close.date_format'    => 'Time must be in correct format',
            'rating.integer'       => 'Rate must be an integer',
        ];
    }
}
