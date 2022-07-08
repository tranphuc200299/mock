<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:workers|min:10|max:11',
            'email' => 'required|email|unique:workers',
        ];
    }
}
