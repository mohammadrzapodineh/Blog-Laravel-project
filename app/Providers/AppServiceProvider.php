<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Post, App\Models\User;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('articleOwner', function (User $user, Post $post)
        {
            return $user->id === $post->user_id;
        });

        Gate::define('adminStaff', function(User $user){
            return $user->is_staff;
        });
        
    
    }
}
