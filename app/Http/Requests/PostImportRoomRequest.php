<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostImportRoomRequest extends FormRequest
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
            'room_id' => 'required|exists:rooms,room_id',
            'quantity' => 'required|integer',
            'stuff_id' => 'required|exists:store_faculties,stuff_id',
        ];
    }
}
