<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Base\ServaiceResult;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Throwable;


class UserService
{
    public  function createUser($validatedData)
    {
        try
        {

        $hashedPassword = Hash::make($validatedData['password']);
        $user = User::create([
            "password" => $hashedPassword,
            ...$validatedData
        ]);

        return new ServaiceResult(isOk:true, data:$user, message:"User Created SuccessFully");
        }
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false,message:$th->getMessage());
        }
    }


    public  function updateUser(User $user, $validatedData)
    {
        try
        {
            $user->update($validatedData);
            return new ServaiceResult(isOk:true, data:$user, message:"User  Updated SuccessFully");
        }
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(isOk:false,message:$th->getMessage());
        }
    }

    public  function destroyUser(User $user)
    {
        try
        {
            $userEmail = $user->name;
            $userId = $user->id;
            $user->delete();
            $data =[
                    "detail" => [
                        "userId" => $userId,
                        "userEmail" => $userEmail,
                        "Message" => "User Has Deleted SuccessFully"
                    ]
                ];
            return new ServaiceResult(true, $data, "User Is Deleted SuccessFully");
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return new ServaiceResult(true, message:"Internal Server Error");
        }
    }
}