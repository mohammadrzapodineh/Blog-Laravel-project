@extends('shared.dashboard.main-layout')


@section('title', 'Create A User')

@section('content')
<div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Update User: {{ $user->name }}</h6>
                            <form method="post" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
                  
                                @csrf
                               @method('put')
                                  <div class="mb-3">
                                    <label for="NameInput" class="form-label">Name</label>
                                    <input value="{{ old("name", $user->name) }}" type="text" name="name" class="form-control" id="NameInput" aria-describedby="nameHelp">
                                    <div id="NameInput" class="form-text">Enter Name of User.
                                    </div>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input value="{{ old("email", $user->email) }}" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                     @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <p class="text text-danger">
                                        {{ $user->password }}
                                    </p>
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="Avatar" class="form-label">Avatar</label>
                                    <input type="file" name="avatar_url"  class="form-control" id="Avatar">
                                    <a href="{{ asset("storage/". $user->avatar_url) }}">
                                        {{ asset("storage/". $user->avatar_url) }}
                                    </a>
                                     @error('avatar')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                        </div>
                    </div>
@endsection