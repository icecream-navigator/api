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

            'name'     => 'required|string|between:5,60',
            'location' => 'required|string|between:5,60',
            'photo'    => 'image:jpeg,png,jpg,gif,svg|max:4048'

        ];
    }

    public function messages()
    {
        return [

            'name.required'     => 'This field is required',
            'name.between'      => 'Must enter 5-20 characters',
            'location.required' => 'Tthis field is required',
            'photo.image'       => 'You must provide image with correct format',
        ];
    }
}
