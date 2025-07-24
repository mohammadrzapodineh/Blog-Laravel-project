            <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="{{ asset('storage/' .$user->avatar_url ) }}">

            <div class="card-body">
              <p class="card-text">User: {{ $user->name }}</p>
              <p class="card-text">Email: {{ $user->email }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">



            <span  class="btn btn-sm btn-outline-secondary"> Articles Count: <span class="text-primary">{{ $user->posts->count() }}</span></span>
            <span  class="btn btn-sm btn-outline-secondary"><a href="{{ route('author-articles', $user) }}">
              User Articles
            </a></span>
                </div>
              </div>
            </div>
          </div>
        </div>