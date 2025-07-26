<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\UserAdminController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Post\PostController, App\Http\Controllers\Post\AuthorArticleController;
use App\Http\Middleware\AuthMiddleware, App\Http\Middleware\CheckUserAdmin;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\UserDashboardController, App\Http\Controllers\Auth\UserRegisterController;


Route::get('', function()
{
   $users = User::orderByDesc('created_at')->paginate(10);

    return view('home', compact('users'));
})->name('home');

    
Route::resource('articles', PostController::class);

Route::get('articles/author/{user}', [AuthorArticleController::class, 'index'])->name('author-articles');


Route::prefix('accounts')->name('account')->group(function (){
    Route::middleware('guest')->get('register', [UserRegisterController::class, 'show'])->name('-register');
    Route::middleware('guest')->post('register', [UserRegisterController::class, 'register'])->name('-register');


    Route::middleware('guest')->get( 'login',[UserLoginController::class, 'show'] )->name('-login');
    Route::middleware('guest')->post( 'login',[UserLoginController::class, 'login'] );
    Route::middleware(AuthMiddleware::class)->get( 'log-out',[UserLoginController::class, 'logout'] )->name('-logout');


    
    Route::middleware('auth')->get('dashboard', [UserDashboardController::class, 'index'])->name('-dashboard');
});

Route::middleware(['auth', CheckUserAdmin::class])->prefix('admin')->name('admin.')->group(function (){

    Route::get('', [AdminDashboardController::class, 'index'])->name('home');
    Route::resource('users', UserAdminController::class);

});





