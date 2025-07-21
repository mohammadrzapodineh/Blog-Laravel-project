@extends('shared.main-layout')



@section('title', "Update Article $article->title")



@section('content')
<h1>Update: {{ $article->title }}</h1><form method="post" action="{{ route('article-update', ["post" => $article->id]) }}"  enctype="multipart/form-data">
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
    <div class="form-group">
    <label for="exampleInputPassword1">Image</label>
    <input name="image_url" type="file" class="form-control" id="exampleInputPassword1">
    <p class="text text-warning">Curent Image:<a href="{{ $article->image_url ? asset("storage/" . $article->image_url) : "#"  }}">{{ $article->image_url ? asset("storage/" . $article->image_url) : "No image Set"  }}</a></p>
    @error('image_url')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
@endsection
