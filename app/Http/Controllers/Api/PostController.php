<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Posts\PostDetailViewRerouce;
use App\Models\Post;
use App\Http\Resources\Api\Posts\PostListResource;
use App\Http\ApiRequests\Admin\Post\PostStoreRequest;
use App\Http\ApiRequests\Admin\Post\PostUpdateRequest;
use App\Services\PostService;


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

        $postService = new PostService();
        $reponse = $postService->createPost($request->validated());

        if (!$reponse->isOk)
        {
            return ApiResponse::error()->response();
        }

        return new PostListResource($reponse->data);

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
        $postService = new PostService();
        $response = $postService->updatePost($post, $request->validated());

        if(!$response->isOk)
        {
            return ApiResponse::error()->response();
        }
        
        return new PostDetailViewRerouce($response->data);

    }   


    public function destroy(Post $post)
    {
        $postService = new PostService();
        $response = $postService->destryoPost($post);

        if (!$response->isOk)
        {
            return ApiResponse::error()->response();
        }

        return ApiResponse::success($response->message, status:204)->response();
    }

}
