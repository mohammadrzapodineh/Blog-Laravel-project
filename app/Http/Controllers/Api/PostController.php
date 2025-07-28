<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Posts\PostUpdateRequest;
use App\Http\Resources\Api\Posts\PostDetailViewRerouce;
use App\Models\Post;
use App\Http\Requests\Api\Posts\PostStoreRequest;
use App\Http\Resources\Api\Posts\PostListResource;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class PostController extends Controller
{


    public function index()
    {
        
        $posts = Post::with('user:id,name')->paginate(20);
        return PostListResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        try
        {

            $validatedData = $request->validated();
            $post = Post::create($validatedData);
            $data = 
            [   "message" => "Your Post Created SuccessFully",
                "detail" => $post
            ];  
            return response()->json($data);


        }
        catch(Throwable $th)
        {
            // Report Execption To Telescope
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "error" => "Internal Erorr Please Contact The Admin"
                ]
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostDetailViewRerouce($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        try
        {
            $validaedData = $request->validated();
            $post->update($validaedData);
            return response()->json(
                [
                    "message" => "Your Post Updated SuccessFully",
                    "detail" => $post
                ]
                );
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "detail" => "Internale Server Erorr"
                ], 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try
        {
            $post->delete();
            return response()->json(
                [
                    "detail" => "Your Post Deleted SuccsessFully"
                ],201
                );
        }
        
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "detail" => "Internale Server Erorr"
                ], 500
            );
        }
    }
}
