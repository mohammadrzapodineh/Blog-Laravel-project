@extends('shared.main-layout')

@section('title', 'Article Create')

@section('content')
<form method="post" action="{{ route('articles.store') }} " enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">title</label>
    <input type="text" class="form-control" name="title" aria-describedby="emailHelp" value="{{ old('title') }}">
        @error('title')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">text</label>
    <input type="text" class="form-control" name="text"id="exampleInputPassword1" value="{{ old('text') }}">
    @error('text')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">category</label>
    <input type="text" class="form-control" name="category"id="exampleInputPassword1" value="{{ old('category') }}">
    @error('category')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>


   <div class="form-group">
    <label for="exampleInputPassword1">image</label>
    <input name="image_url" type="file" class="form-control" name="category"id="exampleInputPassword1">
    @error('image')
    <p class="text-danger">
      {{ $message }}
    </p>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
@endsection