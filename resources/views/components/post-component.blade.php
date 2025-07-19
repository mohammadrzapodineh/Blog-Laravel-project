            <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ Storage::disk('avatars')->url($article->image_url) }}">

            <div class="card-body">
              <p class="card-text">{{ $article->title }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{ route('article-detail', ['post'=> $article->id]) }}" class="btn btn-sm btn-outline-secondary">View</a>
                  <a href="{{ route('article-update', ['post' =>  $article->id]) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                  <form action="{{ route('article-delete', ['post' =>  $article->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>