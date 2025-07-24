            <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/'. $article->image_url) }}">

            <div class="card-body">
              <p class="card-text">{{ $article->title }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('articles.show', ["article"=>$article->id]) }}" class="btn btn-sm btn-outline-secondary">View</a>
                 @auth
                  @can('articleOwner', $article)
                  <a href="{{ route('articles.edit', ["article"=>$article->id]) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                  <form action="{{ route('articles.destroy', ["article"=>$article->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                  @endcan
                 @endauth
                </div>
              </div>
            </div>
          </div>
        </div>