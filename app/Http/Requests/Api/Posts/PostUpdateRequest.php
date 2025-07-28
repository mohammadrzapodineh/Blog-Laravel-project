<?php

namespace App\Http\Requests\Api\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["nullable", "max:225"],
            "category" => ["nullable", "max:110"],
            "text" => ["nullable", "max:500"],
            "image_url" => ["nullable"],
            // Todo:: This Is Test For Set User Id And Please Change To Auth User Not get In Form Request
            "user_id" => ["required", "integer"]
        ];
    }
}
