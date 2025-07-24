<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthorArticleController extends Controller
{

    public function index(User $user)
    {
        $articles = $user->posts()->get();
        $data = 
        [
            'articles' => $articles,
            'author' => $user->name
        ];
        return view('blog.article-list',$data);
    }
}
