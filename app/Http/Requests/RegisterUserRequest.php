<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|alpha|min:3|max:30|regex:/^[A-Z][a-z]{2,15}$/",
            "last_name" => "required|alpha|regex:/^[A-Z][a-z]{2,15}(\s([A-Z][a-z]{2,15})){0,3}$/",
            "email" => "required|email|unique:App\Models\User,email",
            "password" => ["required", Password::min(6)->letters()->numbers(), "alpha_num"]
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Please enter your name ex. Nicolas',
            'last_name.regex' => 'Please enter your last name ex. Jordan',
        ];
    }
}
