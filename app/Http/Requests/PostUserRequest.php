<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
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
            'firstname' => 'require|max:20',
            'lastname' => 'require|max:50',
            'email' => 'email|unique:users',
            'role_id' => 'require'
        ];
    }
    
    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.require' => trans('user.require.firstname'),
            'firstname.max' => trans('user.max.firstname'),
            'lastname.require' => trans('user.require.lastname'),
            'lastname.max' => trans('user.max.lastname'),
            'email' => trans('user.email'),
        ];
    }
}
