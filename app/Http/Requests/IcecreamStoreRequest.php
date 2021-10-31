<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IcecreamStoreRequest extends FormRequest
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

            'flavour'  => 'required|string|between:4,20',
            'type'     => 'required|string|between:2,50',
            'form'     => 'required|string|between:2,50',
            'price'    => 'required|numeric',
            'quantity' => 'required|numeric',
        ];

    }

    public function messages()
    {
        return [

            'flavour.required'  => 'This field is required',
            'type.required'     => 'This field is required',
            'form.required'     => 'This field is required',
            'price.required'    => 'This field is required',
            'quantity.required' => 'This field is required',

            'flavour.string'    => 'You must enter string',
            'type.string'       => 'You must enter string',
            'form.string'       => 'You must enter string',

            'price.numeric'     => 'This field must be numeric',
            'quantity.numeric'  => 'This field must be numeric',

        ];
    }
}
