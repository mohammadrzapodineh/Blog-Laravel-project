<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title','Title Of Page ')</title>


    @include('shared.header-refrences')
    @yield('header-styles')
    
  </head>
  <body>
      @include('shared.header')
<main>
@if (session('messages'))
<div class="alert alert-success" role="alert">
  Message: {{ session('messages') }}.
</div>
@endif
@yield('content')
</main>


    @include('shared.footer')
    @include('shared.footer-refrences')
    @yield('footer-scripts')

  

      
  </body>
</html>
