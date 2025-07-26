    
<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">Personal Blog</h4>
          <p class="text-muted">This Project Made By Laravel and My First Project.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Menu</h4>
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
            <li><a href="{{ route('articles.index') }}" class="text-white">Articles</a></li>
            @auth
            @if(Auth::user()->is_admin)
            <li><a href="{{ route('admin.home') }}" class="text-white">Admin Panel</a></li>
            @endif
            <li><a href="{{ route('account-dashboard') }}" class="text-white">Dashboard</a></li>

            <li><a href="{{ route('account-logout') }}" class="text-white">Log Out</a></li>
            @else
            <li><a href="{{ route('account-login') }}" class="text-white">Login/Register</a></li>

            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Advance Blog</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>
