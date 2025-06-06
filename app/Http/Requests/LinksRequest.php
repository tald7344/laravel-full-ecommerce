<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinksRequest extends FormRequest
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
            'link_name_ar'          => 'required',
            'link_name_en'          => 'required',
            'link_content_ar'       => 'sometimes|nullable',
            'link_content_en'       => 'sometimes|nullable',
            'url'                   => 'sometimes|nullable',
            'hasLink'               => 'required|in:0,1',
            'parent'                => 'sometimes|nullable|numeric',
            'menu_id'               => 'required|numeric'
        ];
    }
}
