@extends('shared.main-layout')
@section('title', 'Articles by Tag')

@section('content')
<div class="album py-5 bg-light">
  <div class="container">

    <!-- Title -->
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold text-dark mb-3">
            Articles with Tag: <!-- tag title here -->
          </h1>
          <p class="lead text-muted">All articles that include the tag {{ $tag->title }}</p>
        </div>
      </div>

      <!-- Search Form -->
      <form class="d-flex justify-content-center mt-3" method="get" action="{{ route('tag.articles', $tag) }}">
        <input name="q" class="form-control w-50 me-2 shadow-sm" type="search" placeholder="Search in Articles ..." aria-label="Search" value="{{ old('q') }}">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </section>

    <!-- Article list and sidebar -->
    <div class="row">
      <!-- Articles Column -->
      <div class="col-lg-8">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">

          <!-- Repeat this block for each article -->
           @forelse($articles as $article)
           <x-post-component :article="$article"></x-post-component>
           @empty
         <p class="text-danger fs-5">There is no article.</p>
           @endforelse
          <!-- End article block -->

        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
          <!-- pagination links here -->
        </div>
      </div>

      <!-- Sidebar -->
    <div class="d-flex justify-content-center mt-5">
            {{ $articles->withQueryString()->links() }}
          </div>
    </div>

  </div>
</div>
@endsection
