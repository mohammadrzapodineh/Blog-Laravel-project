<?php

namespace App\Http\ApiRequests\Auth;
use App\Http\Requests\Api\BaseApiFormRequest;


class LoginUserApiRequest extends BaseApiFormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        
        return[
            "email" => ["email", "required"],
            "password" => ["required"]
        ];
    }
}
