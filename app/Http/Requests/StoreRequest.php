<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'storeName' => 'required|max:254',
            'person_in_charge_name' => 'required|max:254',
            'person_in_charge_phone_number' => 'required|numeric',
            'person_in_charge_email' => 'required|email|max:254',
        ];
    }
}
