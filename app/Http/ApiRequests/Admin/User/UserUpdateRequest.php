<?php

namespace App\Http\ApiRequests\Admin\User;
use App\Http\Requests\Api\BaseApiFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends BaseApiFormRequest
{


    public function authorize(): bool
    {
        return Gate::allows('adminStaff');
    }


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
