<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function show()
    {
        return view('accounts.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('messages', 'You Are Log Out Your Dashboard');
    }
    
    public function login(UserLoginRequest $request)
    {

        $validaedData = $request->validated();
        if (Auth::attempt(["email" => $validaedData['email'], "password" => $validaedData['password']]))
        {
            $request->session()->regenerate();
            return redirect()->route('account-dashboard')->with('messages', 'You Are Login SuesscFull');
            
        }
        return back()->withErrors(['email' => "Your Password Or Email is Invalid"])->onlyInput('email');

    }


}