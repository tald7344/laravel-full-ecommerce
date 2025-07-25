<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewsRequest extends FormRequest
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
            'reviewer_name'           => 'required|string',
            'review_text'             => 'required|string',
            'review'                  => 'required|string|in:1,2,3,4,5',
            'product_id'              => 'required|numeric',
        ];
    }
}
