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

            'name'        => 'required|string|between:5,60',
            'photo'       => 'image:jpeg,png,jpg,gif,svg|max:4048',
            'town'        => 'string|between:3,60',
            'postal_code' => 'string|between:5,60',
            'street'      => 'string|between:5,60',
            'place_name'  => 'string|between:3,60',
            'open'        => 'date_format:H:i',
            'close'       => 'date_format:H:i|after:open',
            'place_name'  => 'string|between:3,60',

        ];
    }

    public function messages()
    {
        return [

            'name.required'     => 'This field is required',
            'name.between'      => 'Must enter 5-20 characters',
            'photo.image'       => 'You must provide image with correct format',
            'open.date_format'  => 'Time must be in correct format',
            'close.date_format' => 'Time must be in correct format',
        ];
    }
}
