<?php

namespace App\Services;
use App\Base\ServaiceResult;
use Throwable;
use App\Models\Post;
use Illuminate\Contracts\Debug\ExceptionHandler;

class PostService
{   
    
    public function createPost($validatedData)
    {
        try
        {

            $post = Post::create($validatedData);
            return new ServaiceResult(isOk:true, data:$post, message:"Your Article Created SuccessFully");

        }
        catch(Throwable $th)
        {
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
}