<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class UserLogOutApi extends Controller
{
    public function __invoke(Request $request)
    {
        try
        {   
            $request->user()->tokens()->delete();
            return ApiResponse::success("User Is Log Out SuccessFully")->response();
        }
        catch(Throwable $th)
        {
            app()[ExceptionHandler::class]->report($th);
            return ApiResponse::error()->response();
        }
    }
}
