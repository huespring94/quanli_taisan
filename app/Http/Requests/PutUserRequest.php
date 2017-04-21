<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PutUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dob' => 'date_format',
            'phone' => 'numberic|between:min:10,max:11|unique:users',
            'address' => 'required|max:500',
        ];
    }
}
