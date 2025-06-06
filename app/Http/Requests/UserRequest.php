<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'level' => 'required|in:user,company,vendor',
            'email' => 'required|email|unique:users',
            'image' => 'sometimes|nullable|' . VImage(),
            'password' => 'required|min:3'
        ];
    }
}
