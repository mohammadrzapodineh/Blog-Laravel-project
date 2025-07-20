@extends('shared.main-layout')

@section('title', 'Register Page')

@section('header-styles')
<link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet">
@endsection


@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post" action="{{ route('account-register') }}" enctype="multipart/form-data" novalidate>
            @csrf
          <!-- Email input -->

          <div data-mdb-input-init class="form-outline mb-4">
                 <label class="form-label" for="form3Example3">Name </label>
            <input name="name" type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter Your Name Here .." value="{{ old('name') }}" />
       

            @error('name')
            <p class="text-danger">{{ $message }}</p>
           @enderror
          </div>
            

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Email address</label>
            <input name="email" type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address" value="{{ old('email') }}" />

            @error('email')
            <p class="text-danger">{{ $message }}</p>
           @enderror
          </div>



          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
             <label class="form-label" for="form3Example4">Password</label>
            <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />
           
            @error('password')
            <p class="text-danger">{{ $message }}</p>
           @enderror
          </div>

          <div data-mdb-input-init class="form-outline mb-3">
             <label class="form-label" for="form3Example4">Confrim </label>
            <input name="password_confirmation" type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" />

            @error('password_confirmation')
            <p class="text-danger">{{ $message }}</p>
           @enderror
          </div>



              <div data-mdb-input-init class="form-outline mb-3">
             <label class="form-label" for="form3Example4">Your Avatar </label>
            <input name="avatar" type="file" id  class="form-control form-control-lg"
              placeholder="Enter password" />

            @error('avatar')
            <p class="text-danger">{{ $message }}</p>
           @enderror
          </div>
          

          <div class="text-center text-lg-start mt-4 pt-2">
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Do You have an account? <a href="{{ route('account-login') }}"
                class="link-danger">Login</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>

</section>
@endsection
