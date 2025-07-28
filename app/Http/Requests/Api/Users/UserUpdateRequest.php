<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Validation\Rules\Password;


class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');
        return[
            "name" => ["nullable", "max:225"],
            "email" => ["required", "email:dns", Rule::unique("users", "email")->ignore($user->id)],
            "password" => ["nullable", new Password(8)],
            "avatar_url" => ["nullable"]
        ];



    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "errors" => $validator->errors()
                ], 422
            )
        );
    }
}
