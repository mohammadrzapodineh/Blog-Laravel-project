<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\UserRegisterSuccessMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRegisterController extends Controller
{
    public function show()
    {
        return view('accounts.register');
    }


    public function register(UserRegisterRequest $request)

    {
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        if ($request->hasFile('avatar'))
        {
            $imageName = $request->file('avatar')->getClientOriginalName();
            $imageUploadPath = $request->file(key: 'avatar')->storeAs('uploads/avatar', $imageName, 'public');
            $validatedData['avatar_url'] = $imageUploadPath;
        }

        $user = User::create([
            "password" => $hashedPassword,
            ...$validatedData
        ]);
        Mail::to($user)->send(new UserRegisterSuccessMail());
        return redirect()->route('home');
    }
}
