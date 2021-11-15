<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpinionStoreRequest extends FormRequest
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
            'opinion'=>'required|string|between:4,250',
        ];
    }

    public function messages()
    {
        return [
            'opinion.required' => 'This field is required',
            'opinion.between'  => 'You must enter 4-250 characters',
        ];
    }
}
