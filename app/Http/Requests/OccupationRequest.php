<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccupationRequest extends FormRequest
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
            'title' => 'required|max:254',
            'description' => 'required|max:254',
            'category_id' => 'required',
//            'image_path.*' => [
//                'mimes:jpeg,jpg,png,gif',
//                'dimensions:ratio=16/9',
//            ],
            'file' =>  [
                function ($attribute, $value, $fail) {
                    if (count($value) < 3) {
                        return $fail('Please  ' . $attribute . ' enter up to 3 photos');
                    }
                }, 'required'
            ],
            'work_address' => 'required|max:254',
            'status' => 'required|max:254',
            'speciality' => 'required|max:254',
            'bring_item' => 'max:254',
        ];
    }
}
