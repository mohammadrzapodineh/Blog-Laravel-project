<?php

namespace App\Http\Resources\Api\Posts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostListRrescourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "posts" => PostListResource::collection($this->collection),
            "meta" => [
                "total_items" => $this->total(),
                "current_page" => $this->url($this->currentPage()),
                "per_page" => $this->perPage(),
                "last_page" => $this->url( $this->lastPage()),
            ],
            "links" => [
                "next" => $this->nextPageUrl(),
                "previuos" => $this->previousPageUrl()
            ]
        ];
    }
}
