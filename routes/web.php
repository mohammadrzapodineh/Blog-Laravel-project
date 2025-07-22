<?php

use App\Rules\NumberRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Post , App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

Route::get('', function()
{
   $users = User::orderByDesc('created_at')->get();

    return view('home', compact('users'));
})->name('home');



Route::prefix('articles')->name('article')->group(function() {

    Route::match(['get', 'post'], 'create', function (Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('blog.article-create');
        }

        if ($request->isMethod('post'))
        {
            $validatedData = $request->validate([
                'title' => ['required', 'min:5', 'max:255', new NumberRule],
                'text' => ['required', 'max:500'],
                'category' => ['required', 'min:5'],
                'image' => ['nullable', 'mimes:jpg,png,jpeg'],

            ]
            );

            $newPost = Post::create([
                'user_id' => 5,
                'image_url' => $validatedData['image'],
                ...$validatedData
            ]);

            if($request->hasFile('image'))
            {

                
                $articleImageName =  $validatedData["title"] . "-." . $request->file('image')->getClientOriginalExtension();
                $articleImagePath = $request->file('image')->storeAs('uploads/articles/', $articleImageName, 'public');
                $newPost->image_url = $articleImagePath;
                $newPost -> save();
            }
            return redirect()->route('article-list')->with('messages', 'Article Is Created Successfully');
        }
    })->name('-create');;
    



    Route::match(['get', 'put'], 'update/{post}/', function(Request $request, Post $post)
    {
        $article = $post;
        if($request->isMethod('get'))
        {   
            
            return view('blog.article-update', compact('article'));

        }

        if ($request->isMethod('put'))
        {
            $validatedData = $request->validate([
                'title' => ['required', 'min:5', 'max:255', new NumberRule],
                'text' => ['required', 'max:500'],
                'category' => ['required', 'min:5'],
                'image_url' => ['nullable', 'image', 'max:3034', 'mimes:jpg,png']
            ]
            );

            if($request -> hasFile('image_url'))
            {
                $randomNumber = random_int(100, 2000);
                $clened_name = str_replace(' ', '-', $article->title);
                $imageFileName = $clened_name . "-$randomNumber.". $request->file('image_url')->getClientOriginalExtension();
                $imagePath = $request->file('image_url')->storeAs('uploads/articles', $imageFileName, 'public');
                $validatedData['image_url'] = $imagePath;
            }
            $article->update($validatedData);
            $message = "Article:$article->title  Has Updated Successfully";
            return redirect()->route(route: 'article-list')->with("messages", $message);
        }
    })->name('-update');


    Route::delete('delete/{post}', function(Request $request, Post $post)
    {
        $artcle = $post;
        $message = "Article: $artcle->title   Has Deleted Successfully";
        $artcle->delete();
        return redirect()->route(route: 'article-list')->with("messages", $message);
    })->name('-delete'); 



    Route::get('', function ()
    {  
        $articles = Post::orderByDesc('updated_at')->get();
        return view('blog/article-list', compact('articles'));
    })->name('-list');

    Route::get('{post}', function (Post $post)
    {   
        $article = $post;
        return view('blog/article-detail', compact('article'));
    })->name('-detail');


        Route::get('author/{user}/articles', function (User $user)
    {   

        $articles = $user->posts()->get();
        $author = $user->name;
        $data = [
            "articles" => $articles,
            "author" => $author
        ];

        return view('blog/article-list', $data);
    })->name('-author-articles');




});


Route::prefix('accounts')->name('account')->group(function (){
    Route::match(['get', 'post'], 'register', function (Request $request){
        if($request->isMethod('get'))
        {
            return view('accounts.register');
        }

        if($request->isMethod('post'))
        {
       
            $validatedData = $request->validate(
                
                [
                    "name" => ['required', 'max:220'],
                    'email' => ['required', 'email'],
                    'password' => ['required',  new Password(8), 'confirmed'],
                    'avatar' => ['mimes:jpg,png', 'nullable', 'image', 'max:3048']

                ]
                );
            $hashedPassword = Hash::make($validatedData['password'], ['rounds' => 12]);
            $userExsits = User::where('email', $validatedData['email'])->first();
            if (!$userExsits)
            {    $user = User::create([
                    'password' => $hashedPassword,
                    ...$validatedData
                ]);

                if ($request->hasFile('avatar'))
                {
                    $imageFileName ="avatar-$user->email." . $request->file('avatar')->getClientOriginalExtension();
                    $imagePath = $request->file('avatar')->storeAs('uploads/avatar/', $imageFileName ,'public');
                    $user->avatar_url = $imagePath;
                    $user->save();
                }
                return redirect()->route('account-login')->with('messages', 'Your Account Created Susccessfully You Can Login ! ');
            }
            return redirect()->back()->withErrors(['email' => "This Email Is Taken"]);
        }
    })->name('-register');


    Route::match(['get', 'post'], 'login',  function(Request $request){
        if($request->isMethod('get'))
        {
            return view('accounts.login');
        }

        if ($request->isMethod('post'))
        {
            $validatedData = $request->validate(
                [
                    "email" => ["required", "email"],
                    "password" => ['required', new Password(8)]
                ]
                );
            
                $user = User::where("email", $validatedData['email'])->first();
                if ($user &&  Hash::check($validatedData['password'], $user->password))
                {
                
                    
                    return redirect()->route('account-dashboard')->with('messages', 'You Are Login SuccessFully');
                    
                }
                return redirect()->back()->withErrors(['password' => "Your Email Or Password Is Invalid"]);
        }

    })->name('-login');


    Route::get('dashboard', function(Request $request)
    {

        return view(view: 'accounts.dashboard');
    })->name('-dashboard');
});