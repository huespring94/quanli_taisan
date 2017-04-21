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
            'faculty_id' => 'required|exists:faculties,faculty_id',
            'quantity' => 'required|integer',
            'stuff_id' => 'required|exists:stuffs,stuff_id',
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
            'quantity.required' => 'Yêu cầu nhập số lượng',
            'quantity.integer' => 'Yêu cầu nhập số',
            'quantity.min' => 'Số lượng luôn lớn hơn 1',
            'faculty_id.required' => 'Yêu cầu chọn khoa',
            'stuff_id.required' => 'Yêu cầu chọn tài sản',
        ];
    }
}
