<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserDashboardController extends Controller
{
    public function index()
    {

        return view('accounts.dashboard');
    }
}
