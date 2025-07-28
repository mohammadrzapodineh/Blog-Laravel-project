<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request, Tag $tag)
    {
        $querySearch = $request->get('q');
        $query = $tag->posts()->latest();
        if ($querySearch) {
         $query->where(column: function ($q) use ($querySearch) {
        $q->where('title', 'LIKE', "%{$querySearch}%")
          ->orWhere('text', 'LIKE', "%{$querySearch}%");
    });
        }
        $articles = $query->paginate(1);
        $data = 
        [
            "tag" => $tag,
            "articles" => $articles     
        ];
        return view('tag.tag-articles-list', $data);
    }
}
