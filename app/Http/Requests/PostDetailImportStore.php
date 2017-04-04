<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDetailImportStore extends FormRequest
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
            'quantity' => 'required',
            'price_unit' => 'required',
            'status' => 'required',
            'stuff_id' => 'required',
            'import_store_id' => 'required'
        ];
    }
}
