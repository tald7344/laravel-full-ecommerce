<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatesRequest extends FormRequest
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
            'states_name_ar' => 'required',
            'states_name_en' => 'required',
            'country_id' => 'required',
            'city_id' => 'required'
        ];
    }
}
