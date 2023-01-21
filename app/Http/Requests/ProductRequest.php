<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $back = [
            "name" => "required|string|min:5|max:40",
            "price" => "required|numeric|min:1",
            "brand" => "required|exists:App\Models\Brand,id",
            "description" => "required|string|min:20"
        ];
        if(!$request->has("update")) {
            $back["image"] = "required|file|image|max:5000";
        }
        return $back;
    }
}
