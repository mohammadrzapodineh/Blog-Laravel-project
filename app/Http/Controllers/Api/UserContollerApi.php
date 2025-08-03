<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\ApiRequests\Admin\User\UserStoreRequest;
use App\Http\ApiRequests\Admin\User\UserUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\Api\Users\UserDetailResource;
use App\Http\Resources\Api\Users\UserListReource;
use App\Http\Resources\Api\Users\UserListRrescourceCollection;

use App\Services\UserService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Gate;
use Throwable;

class UserContollerApi extends Controller
{

    public function __construct(public UserService $userService)
    {

    }


    public function index()
    {
        if (!Gate::allows('adminStaff'))
        {
            return ApiResponse::error("Access Diend", status:403)->response();
        }
        $users = User::paginate(2);
    
        return ApiResponse::success( data:new UserListRrescourceCollection($users), status: 201)->response();
    }


    public function store(UserStoreRequest $request)
    {
        $userService = $this->userService->createUser($request->validated());
        if($userService->isOk)
        {
            $user = new UserDetailResource($userService->data);
            return ApiResponse::success($userService->message, $user, 201)->response();
        }

        return ApiResponse::error($userService->message, status:500)->response();

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
        $userService = $this->userService->updateUser($user, $request->validated());
        if ($userService->isOk)
        {
            $serializedUser = new UserDetailResource($userService->data);
            return ApiResponse::success($userService->message, $serializedUser, 200)->response();
        }

        return ApiResponse::error($userService->message, status:500)->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $userService = $this->userService->destroyUser($user);
        if($userService->isOk)
        {
            
            return ApiResponse::success($userService->message, $userService->data, 204)->response();
        }
        return ApiResponse::error($userService->message, status:500)->response();
    }
}
