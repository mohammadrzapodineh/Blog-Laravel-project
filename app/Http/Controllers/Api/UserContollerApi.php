<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Users\UserRequest as UserRequestApi;
use App\Http\Resources\Api\Users\UserDetailResource;
use App\Http\Resources\Api\Users\UserListReource;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class UserContollerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
    
        return UserListReource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequestApi $request)
    {
        
        try
        {
        $validatedData = $request->validated();
        $hashedPassword = Hash::make($validatedData['password']);
        $user = User::create([
            "password" => $hashedPassword,
            ...$validatedData
        ]);
        return new UserDetailResource($user);
        }
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json([
                "message" => "Internal Erorr"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserDetailResource($user);
    

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try
        {
            $validatedData = $request->validated();
            $user->update($validatedData);
            return new UserDetailResource($user);
        }
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "detail" => "Internal Eror Please contact To Admin"
                ],500
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try
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

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "detail" => "Internal Erorr"
                ], 500
                );
        }

    }
}
