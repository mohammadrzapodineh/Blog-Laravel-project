<?php

namespace App\Http\Requests\Api\Users;
use Illuminate\Validation\Rule;
use App\Http\Requests\Api\BaseApiFormRequest;

use Illuminate\Validation\Rules\Password;


class UserUpdateRequest extends BaseApiFormRequest
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
}
