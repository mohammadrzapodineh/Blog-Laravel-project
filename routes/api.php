<?php

use App\Http\Controllers\Api\GetArticlesByTagApi;
use App\Http\Controllers\Api\UserContollerApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagControllerApi;


Route::prefix('v1')->name('api.')->group(function ()
{

Route::apiResource('posts', PostController::class);
Route::apiResource('users', UserContollerApi::class);
Route::apiResource('tags', TagControllerApi::class);
Route::get('tags/articles/{tag}', [GetArticlesByTagApi::class, 'index']);
});