<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerProfileRequest extends FormRequest
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
            'first_name' => 'required|max:254',
            'last_name' => 'required|max:254',
            'furigana_first_name' => 'required|max:254',
            'furigana_last_name' => 'required|max:254',
             'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:11',
            'email' => 'required|email',
        ];
    }
}
