<?php

namespace App\Http\Requests\api\v1;

use App\Http\Requests\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Invalid email address!',
            'email.required' => 'email is required!',
            'password.required' => 'password is required!',
            'password.min' => 'Password must be at least 6 characters or more!'
        ];
    }
}
