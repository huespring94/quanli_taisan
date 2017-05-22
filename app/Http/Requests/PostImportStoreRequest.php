<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostImportStoreRequest extends FormRequest
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
            'date_import' => 'required|before:tomorrow|date_format:' . config('define.date_format'),
            'store_id' => 'required|exists:stores,id'
        ];
    }
}
