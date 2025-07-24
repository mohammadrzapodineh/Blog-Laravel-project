<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
                'title' => ['required', 'max:255'],
                'text' => ['required', 'max:500'],
                'category' => ['required', 'min:5'],
                'image_url' => ['image', 'max:3034', 'mimes:jpg,png']
        ];
        if ($this->isMethod('PUT'))
        {
            array_push($rules['image_url'], 'nullable');
        }

        return $rules;
    }
}
