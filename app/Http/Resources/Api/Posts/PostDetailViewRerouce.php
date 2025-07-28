<?php

namespace App\Http\Resources\Api\Posts;

use App\Http\Resources\Api\Users\UserListReource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailViewRerouce extends JsonResource
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
            "title" => $this->title,
            "text" => $this->text,
            "image_url" => $this->image_url,
            "category" => $this->category,
            "slug"  => $this->slug,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "user" => new UserListReource($this->user)
        ];
    }
}
