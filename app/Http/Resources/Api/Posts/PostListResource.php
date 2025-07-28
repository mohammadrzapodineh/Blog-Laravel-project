<?php

namespace App\Http\Resources\Api\Posts;

use App\Http\Resources\Api\Users\UserListReource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category" => $this->category,
            "snipted_text" => $this->snipted_text,
            "slug" => $this->slug,
            "image_url" => $this->image_url,
            "author" => new UserListReource($this->user)
        ];
    }
}
