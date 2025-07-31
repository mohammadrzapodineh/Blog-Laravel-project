<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class AuthorArticleController extends Controller
{

    public function index(User $user)
    {

        $querySearch = request()->get('q');
        $query = Post::query()->where('user_id', $user->id);
        if ($querySearch) {
         $query->where(function ($q) use ($querySearch) {
        $q->where('title', 'LIKE', "%{$querySearch}%")
          ->orWhere('text', 'LIKE', "%{$querySearch}%");
    });
}
        $articles = $query->orderByDesc('updated_at')->paginate(1);

        $tags = Tag::all();
        $data = 
        [
            'articles' => $articles,
            'author' => $user,
            "tags" => $tags
        ];
        return view('blog.article-list',$data);
    }
}
