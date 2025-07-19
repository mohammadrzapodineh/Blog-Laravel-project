@extends('shared.main-layout')



@section('title', "Update Article $article->title")


@section('content')
@section('content')
<h1>Update: {{ $article->title }}</h1>
<form method="post" action="{{ route('article-update', ["post" => $article->id]) }}">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">title</label>
    <input type="text" class="form-control" name="title" aria-describedby="emailHelp" value="{{ old('title', $article->title) }}">
        @error('title')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">text</label>
    <input type="text" class="form-control" name="text"id="exampleInputPassword1" value="{{ old('text', $article->text) }}">
    @error('text')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">category</label>
    <input type="text" class="form-control" name="category"id="exampleInputPassword1" value="{{ old('category', $article->category) }}">
    @error('category')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
@endsection
@endsection