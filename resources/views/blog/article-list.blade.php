@extends('shared.main-layout')
@section('title', 'Article List')

@section('content')
  <div class="album py-5 bg-light">
    <div class="container">
      <!-- Title -->
      <section class="py-5 text-center container">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-bold text-dark mb-3">
              @if(isset($author))
              {{ "Articles of: $author->name" }}
              @else
              {{ "Articles List" }}
              @endif
            </h1>
            <p class="lead text-muted">You can see all of articles on this site</p>
            <p>
              <a href="{{ route('articles.create') }}" class="btn btn-outline-primary btn-lg">Create Article</a>
            </p>
          </div>
        </div>

        <!-- Search Form -->
        <form class="d-flex justify-content-center mt-3" method="get" action="{{ isset($author) ? route("author-articles", $author) : route('articles.index') }}">
          <input name="q" class="form-control w-50 me-2 shadow-sm" type="search" placeholder="Search in Articles ..." aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </section>

      <!-- Article list and sidebar -->
      <div class="row">
        <!-- Articles Column -->
        <div class="col-lg-8">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
            @forelse($articles as $article)
              <x-post-component :article="$article"></x-post-component>
            @empty
              <p class="text-danger fs-5">There is no article.</p>
            @endforelse
          </div>

          <div class="d-flex justify-content-center mt-5">
            {{ $articles->withQueryString()->links() }}
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
          <!-- Categories -->

          <!-- Tags -->
          <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
              <h5 class="mb-0">Latest Tags</h5>
            </div>
            <div class="card-body">
              @forelse($tags as $tag)
                <a href="{{ $tag->getAbsoluteUrl() }}" class="badge bg-dark text-white text-decoration-none m-1 p-2">{{ $tag->title }}</a>
              @empty
                <p class="text-muted">No tags</p>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
