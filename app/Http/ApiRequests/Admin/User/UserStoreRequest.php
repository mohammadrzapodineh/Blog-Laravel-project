<?php

namespace App\Http\ApiRequests\Admin\User;
use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends BaseApiFormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        
        return [
            "name" => ["required", "max:225"],
            "email" => ["required", "email:dns", "unique:users,email"],
            "password" => ["required", new Password(8)],
            "avatar_url" => ["nullabale"]
        ];
    }
}
