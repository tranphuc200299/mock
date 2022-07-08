<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillsRequest extends FormRequest
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
        'name'=>'required|min:3|max:254',
        'description'=>'required|max:254',
        ];
    }
    public function message(){
       return [
        'name.required'=>':attribute Required ',
        'name.min'=>':attribute must not be less than min characters',
        'description.required'=>':attribute Required',

       ];
    }
    public function attributes (){
        return [
            'name'=>'name',
            'description'=> 'description'
        ];
    }
}
