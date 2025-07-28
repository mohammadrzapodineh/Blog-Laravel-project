<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\Api\Posts\PostListResource;

class GetArticlesByTagApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag)
    {
        $query = $tag->posts();
        $serachKeyWord = request()->get('q');
        if ($serachKeyWord)
        {
            $query->where(function ($q) use ($serachKeyWord){
                $q->where("title", "LIKE", "%{$serachKeyWord}%")->orWhere("text", "LIKE", "%{$serachKeyWord}%");
            });
        }
        return PostListResource::collection($query->get());
    }

}
