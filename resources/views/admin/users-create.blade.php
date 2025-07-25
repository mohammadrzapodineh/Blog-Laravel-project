@extends('shared.dashboard.main-layout')


@section('title', 'Create A User')

@section('content')
<div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Create New User</h6>
                            <form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                @csrf
                                  <div class="mb-3">
                                    <label for="NameInput" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="NameInput" aria-describedby="nameHelp">
                                    <div id="NameInput" class="form-text">Enter Name of User.
                                    </div>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                     @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                    <div class="mb-3">
          <div data-mdb-input-init class="form-outline mb-3">
             <label class="form-label" for="form3Example4">Confrim </label>
            <input name="password_confirmation" type="password" id="form3Example4" class="form-control"
             />
                                     @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>

                                        <div class="mb-3">
                                    <label for="Avatar" class="form-label">Avatar</label>
                                    <input type="file" name="avatar"  class="form-control" id="Avatar">
                                     @error('avatar')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
@endsection