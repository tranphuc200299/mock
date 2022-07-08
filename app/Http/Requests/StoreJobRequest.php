<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'numberOfPeople'=>'required|numeric|min:1',
            'breakTime'=>'numeric',
            'salaryPerHour'=>'required|numeric',
            'time.*.workDate'=>'required',
            'time.*.workTime'=>'required',
            'time.*.workingTimeTo'=>'required',
            'time.*.workingTimeFrom'=>'required',
        ];
    }

    public function attributes (){
        return [
            'time.*.workDate'=>'work date',
            'time.*.workTime'=>'work time',
            'time.*.workingTimeTo'=>'working time to',
            'time.*.workingTimeFrom'=>'working time from',
        ];
    }
    public function messages()
    {
        return [
        ];
    }
}
