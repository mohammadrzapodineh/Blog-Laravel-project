@extends('shared.main-layout')

@section('content')
<h1>{{ $article->title }}</h1>
<p class="text">
    {{ $article->text }}
</p>
@endsection