<?php

namespace Database\Seeders;

use App\Models\User, App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    User::factory()->count(10)->has(
    //     Post::factory()->count(10)
    //    )->create();
    User::factory()->state([
        "name" => "adminUser",
        "email" => "admin@admin.com",
        "password" => Hash::make("12345678")
    ])->create();
    User::factory()->count(10)->hasposts(10)->create();

    }
}
