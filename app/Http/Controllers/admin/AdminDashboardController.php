<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminDashboardController extends Controller
{
    public function index()
    {   
        $users = User::orderByDesc('created_at')->limit(10)->get();
        return view('admin.home', compact('users'));

    }
}
