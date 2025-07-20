            <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/' .$user->avatar_url ) }}">

            <div class="card-body">
              <p class="card-text">User: {{ $user->name }}</p>
              <p class="card-text">Email: {{ $user->email }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">

            <a href="{{ route('article-author-articles', ['user' =>  $user]) }}" class="btn btn-sm btn-outline-secondary">Articles</a>
            <span  class="btn btn-sm btn-outline-secondary"> Articles Count: <span class="text-primary">{{ $user->posts->count() }}</span></span>
                </div>
              </div>
            </div>
          </div>
        </div>