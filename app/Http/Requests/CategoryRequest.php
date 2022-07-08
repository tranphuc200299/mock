<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        'description'=>'required',
        ];
    }
    public function message(){
       return [
        'name.required'=>':attribute Required ',
        // 'name.unique'=>':attribute unique ',
        'name.min'=>':attribute must not be less than min characters',
        'description.required'=>':attribute Required  ',
        // 'description.unique'=>':attribute unique  ',

       ];
    }
    public function attributes (){
        return [
            'name'=>'name',
            'description'=>'description'
        ];
    }
}
