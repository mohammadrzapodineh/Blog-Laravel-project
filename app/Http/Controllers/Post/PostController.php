<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
             new Middleware(middleware: 'auth',except:['index', 'show'])
        ];
    
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Post::orderBy('updated_at', 'desc')->paginate(2);
        return view('blog.article-list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.article-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();
        $randomInt = random_int(100, 2000);
        $imageName = $randomInt .  $request->file('image_url')->getClientOriginalName();
        $imageFileUploadPath = $request->file('image_url')->storeAs('uploads/articles', $imageName, 'public');
        $validatedData['image_url'] = $imageFileUploadPath;
        $validatedData['user_id'] = Auth::id();
        Post::create([
            ...$validatedData
        ]);
        return redirect()->route('articles.index')->with('messages', 'Your Article Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $article)
    {
        $comments = $article->comments;
        $data = 
        [
            "comments" => $comments,
            "article" => $article
        ];
        return view('blog.article-detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $article)
    {
        if(Gate::denies('articleOwner', $article))
        {
            abort(403);
        }
        return view('blog.article-update', compact('article'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $article)
    {
        if(Gate::denies('articleOwner', $article))
        {
            abort(403);
        }
        $validatedData = $request->validated();
            if($request -> hasFile('image_url'))
            {
                $randomNumber = random_int(100, 2000);
                $clened_name = str_replace(' ', '-', subject: $article->title);
                $imageFileName = $clened_name . "-$randomNumber.". $request->file('image_url')->getClientOriginalExtension();
                $imagePath = $request->file('image_url')->storeAs('uploads/articles', $imageFileName, 'public');
                $validatedData['image_url'] = $imagePath;
            }
            $article->update($validatedData);
            $message = "Article:$article->title  Has Updated Successfully";
            return redirect()->route(route: 'articles.index')->with("messages", $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $article)
    {
        if(Gate::denies('articleOwner', $article))
        {
            abort(403);
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Your Article Has Been Deleted SuccesFully');
    }
}
