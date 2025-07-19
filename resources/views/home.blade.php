@extends('shared.main-layout')
@section('title', 'Home Page')




@section('content')
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome To My Personal Blog</h1>
        <p class="lead text-muted">This is My First Laravel Project </p>
        <p>
          <a href="{{ route('article-list') }}" class="btn btn-primary my-2">More Articles</a>
          <a href="{{ route('account-login') }}" class="btn btn-warning my-2">Login/Register</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($articles as $article)
        <x-post-component :article="$article"></x-post-component>
        @empty
        <p class="text text-danger">There is Not Article</p>
        @endif        

      </div>
    </div>
  </div>

@endsection