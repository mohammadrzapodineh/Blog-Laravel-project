<?php

namespace App\Http\Resources\Api\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;


class UserListRrescourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "users" => UserListReource::collection($this->collection),
            "meta" => [
                "current_page" => $this->url($this->currentPage()),
                "last_page" => $this->url($this->lastPage()),
                "total_item" => $this->total(),
                "page_item_count" => $this->count(),
                "per_page" => $this->perPage()

            ],
            "links" => [
                "next" => $this->nextPageUrl(),
                "previous" => $this->previousPageUrl(),
            ]
        ];
    }
}
