<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\Api\Users\UserRequest as UserRequestApi;

class UserContollerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        
        return response()->json(
            [
                "detail" => $users
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequestApi $request)
    {
        
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        $user = User::create([
            "password" => $hashedPassword,
            ...$validatedData
        ]);
        return response()->json([
            "detail" => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            "detail" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $userEmail = $user->name;
        $userId = $user->id;
        $user->delete();
        return response()->json(
            [
                "detail" => [
                    "userId" => $userId,
                    "userEmail" => $userEmail,
                    "Message" => "User Has Deleted SuccessFully"
                ]
            ]
                );

    }
}
