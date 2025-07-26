@extends('shared.main-layout')
@section('title', 'Home Page')




@section('content')
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome To My Personal Blog</h1>
        <p class="lead text-muted">This is My First Laravel Project </p>
        <p>
          <a href="{{ route('articles.index') }}" class="btn btn-primary my-2">More Articles</a>
         @auth
          <a href="{{ route('articles.create') }}" class="btn btn-success my-2">Create Your Article</a>

        @else
         <a href="{{ route('account-login') }}" class="btn btn-warning my-2">Login/Register</a>
         @endauth
        </p>
      </div>
      <br>
      
    </div>
  </section>
  
  <div class="album py-5 bg-light">
  <h2 class="fw-light text-center">Recent Authors</h1>
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($users as $user)
        <x-user-component :user="$user"></x-user-component>
        @empty
        <p class="text text-danger">There is Not Article</p>
        @endif        

      </div>
      @if($users->links())
        <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>

      @endif
    </div>
  </div>

@endsection