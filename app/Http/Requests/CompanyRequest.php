<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'companyName' => 'required|max:254',
            'registerName' => 'required|max:254',
            'city' => 'required',
            'district' => 'required',
            'zipCode' => 'required|numeric',
            'hpUrl' => 'required|max:254',
            'area' =>  [
                function ($attribute, $value, $fail) {
                    if (count($value) > 5) {
                        return $fail('The ' . $attribute . ' must be less than 5');
                    }
                }, 'required'
            ],
            'contactName' => 'required|max:254',
            'phoneNumber' => 'numeric|required',
            'email' => 'required|email|max:254',
            'career' => 'required|max:254'
        ];
    }
}
