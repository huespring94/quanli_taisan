<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostImportFacultyRequest extends FormRequest
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
            'faculty_id' => 'required',
            'quantity' => 'required|integer',
            'stuff_id' => 'required',
        ];
    }
    
    /**
     * Messages
     *
     * @return mixed
     */
    public function messages()
    {
        return [
            'quantity.required' => 'yeu cau so luong',
            'quantity.integer' => 'yeu cau so',
            'faculty_id.required' => 'yeu cau khoa',
            'stuff_id.required' => 'yeu cau stuff',
        ];
    }
}
