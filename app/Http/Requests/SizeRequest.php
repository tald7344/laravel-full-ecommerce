<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'sizes_name_ar'         => 'required',
            'sizes_name_en'         => 'required',            
            'department_id'         => 'required|numeric',
            'is_public'             => 'required|in:yes,no',
        ];
    }
}
