<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\ApiRequests\Auth\LoginUserApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Users\UserListReource;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserLoginApi extends Controller
{
    public function __invoke(LoginUserApiRequest $request)
    {
        try
        {
            $validatedData = $request->validated();
            if (!Auth::attempt($validatedData))
            {
                return ApiResponse::error("Your Credentials is InValid", status:401)->response();
            }

            $user = Auth::user();
            $token = $user->createToken("Login Token")->plainTextToken;
            $data = [
                "token" => $token,
                "user" => new UserListReource($user)
            ];
            return ApiResponse::success("User Is Login SuccessFully", status:200, data:$data)->response();
        }

        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return response()->json(
                [
                    "errors" => "InternalServer Error",
                ], 500
            );
        }
        
    }
}
