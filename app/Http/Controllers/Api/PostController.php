<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Users\UserRequest As UserRequestApi;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\http\Middleware\CheckUserAdmin;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        $data = 
        [
            "detail" => $posts
        ];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequestApi $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json(
            [
                "Detail" => $post
            ]
            );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
