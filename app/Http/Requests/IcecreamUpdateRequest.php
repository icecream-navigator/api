<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IcecreamUpdateRequest extends FormRequest
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

            'flavour'  => 'string|between:4,20',
            'type'     => 'string|between:2,50',
            'form'     => 'string|between:2,50',
            'price'    => 'numeric',
            'quantity' => 'numeric',

        ];
    }

    public function messages()
    {
        return [

            'flavour.string'    => 'You must enter string',
            'type.string'       => 'You must enter string',
            'form.string'       => 'You must enter string',
            'price.numeric'     => 'This field must be numeric',
            'quantity.numeric'  => 'This field must be numeric',

        ];
    }
}
