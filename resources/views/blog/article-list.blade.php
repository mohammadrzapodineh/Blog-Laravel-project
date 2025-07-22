@extends('shared.main-layout')
@section('title', 'Article List')

@section('content')
  <div class="album py-5 bg-light">
    <div class="container">
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">
          @if(isset($author))
          {{ "Articles of: $author" }}
          @else
          {{ "Articles List" }}
          @endif
        </h1></h1><p>You Can See All of Article This My Site</p>
        <p>
          <a href="{{ route('article-create') }}" class="btn btn-primary my-2">Create Article</a>
        </p>
      </div>
    </div>
  </section>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse($articles as $article)
        <x-post-component :article="$article"></x-post-component>
        @empty
        <p class="text text-danger">There is Not Article</p>
        @endforelse

      </div>
    </div>
  </div>
@endsection