<?php

namespace App\Http\Controllers\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CommanetRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function store(CommanetRequest $request, Post $post)
    {
        $validatedData = $request->validated();
        Comment::create(
            [
                "post_id" => $post->id,
                ...$validatedData
            ]
            );
        return redirect()->route('articles.show', $post->id)->with("message", "Your Comment Creted Succussfully!");
    }


    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        if(Gate::denies('articleOwner',  $post))
        {
            abort(403);
        }
        $comment->delete();
        return redirect()->route('articles.show', $post->id)->with("message", " Comment Deleted SuccessFully");
    }
}
