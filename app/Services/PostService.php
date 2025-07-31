<?php

namespace App\Services;
use App\Base\ServaiceResult;
use Throwable;
use App\Models\Post;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;

class PostService
{   
    
    public function createPost($validatedData)
    {
        DB::beginTransaction();

        try
        {

            $post = Post::create($validatedData);
            DB::commit();
            return new ServaiceResult(isOk:true, data:$post, message:"Your Article Created SuccessFully");

        }
        catch(Throwable $th)
        {
            DB::rollBack();
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false, message:"InterNal Server Error");

        }
    }

    public function updatePost($post, $validatedData)
    {
        try
        {
            $post->update($validatedData);
            return new ServaiceResult(isOk:true, data:$post, message:"Article: $post->id is Updated SuccessFully !");
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false, message:"InterNal Server Error");
        }
    }


    public function destryoPost($post)
    {
        try
        {
            $post->delete();
            return new ServaiceResult(isOk:true, message:"Article Has Deleted SuccessFully");
        }
        
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false, message:"Internal Server Error");
        }
    }

    public function getAllPosts($paginatedBy=20)
    {

        try
        {
            $posts = Post::with('user:id,name')->paginate(perPage: $paginatedBy);
            return new ServaiceResult(isOk:true, data:$posts);
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false, message:"Internal Server Error");
        }
    }
}