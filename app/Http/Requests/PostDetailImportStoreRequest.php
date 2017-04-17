<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDetailImportStoreRequest extends FormRequest
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
            'quantity' => 'required|integer',
            'price_unit' => 'required',
            'status' => 'required',
            'stuff_id' => 'required',
            'import_store_id' => 'required'
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
            'quantity.required' => trans('user.require.firstname'),
            'quantity.integer' => 'integer',
            'price_unit.required' => trans('user.max.firstname'),
            'status.required' => trans('user.require.lastname'),
        ];
    }
}
