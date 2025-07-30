<?php

namespace App\Http\ApiRequests\Admin\Post;
use App\Http\Requests\Api\BaseApiFormRequest;


class PostUpdateRequest extends BaseApiFormRequest
{


    public function authorize(): bool
    {
        return true;
    }


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
