<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\http\Requests\UserRegisterRequest;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(5);
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->user();
        if(Gate::denies('adminStaff', $user))
        {
            abort(403);
        }
        return view('admin.users-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $request)
    {
        $validatedData = $request->validated();
        
        if($request->hasFile('avatar'))
        {
            $imageName = $validatedData['name']. "-" . $request->file('avatar')->getClientOriginalName();
            $imagePath = $request->file('avatar')->storeAs('uploads/avatar', $imageName, 'public');
            $validatedData['avatar'] = $imagePath;
        }

        User::create([
            "avatar_url" => $validatedData['avatar'],
            ...$validatedData
        ]);
        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if(Gate::denies('adminStaff', $user))
        {
            abort(403);
        }
        return view('admin.users-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEditRequest $request, User $user)
    {
        if(Gate::denies('adminStaff', $user))
        {
            abort(403);
        }
        $validaedData = $request->validated();
        if ($request->hasFile('avatar_url'))
        {
            $imageName = $validaedData['name']. "-" . $request->file('avatar_url')->getClientOriginalName();
            $imagePath = $request->file('avatar_url')->storeAs('uploads/avatar', $imageName, 'public');
            $validaedData['avatar_url'] = $imagePath;
        }

        if ($user->email !== $validaedData['email'])
        {
            $emailExists = User::where('email', $validaedData['email'])->first();
            if($emailExists !== null)
            {

                return back()->withErrors(["email" => "This Email is Taken"])->onlyInput('email');
            }


        }
        $user->update([...$validaedData]);
        return redirect()->route('admin.users.index')->with('messages', 'Your User is updated Successfully');


        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Gate::denies('adminStaff'))
        {
            abort(403);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('messages', 'Your User is Deleted Successfully');
    }
}
