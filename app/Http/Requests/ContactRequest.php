<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "email" => "required|email",
            "message" => "required|string|min:8"
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Please enter your name ex. Nicolas'
        ];
    }
}
