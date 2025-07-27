@extends('shared.main-layout')

@section('content')

<div class="container my-5">

    {{-- Title --}}
    <h1 class="display-5 fw-bold text-primary mb-3">{{ $article->title }}</h1>

    {{-- Meta Info --}}
    <div class="mb-4 text-muted">
        <span>By <strong>{{ $article->user->name }}</strong></span> |
        <span>Category: <span class="badge bg-info text-dark">{{ $article->category ?? 'Uncategorized' }}</span></span> |
        <span>Tags: 
            @forelse ($article->tags as $tag)
                <span class="badge bg-secondary">{{ $tag->title }}</span>
            @empty
                <span class="text-muted">No tags</span>
            @endforelse
        </span>
    </div>

    {{-- Article Text --}}
    <p class="lead">{{ $article->text }}</p>

    <hr class="my-5" />

    {{-- Comments --}}
<h4 class="mb-4 text-dark">Comments</h4>
@forelse($comments as $comment)
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-start">
            <div>
                <p class="mb-1">{{ $comment->text }}</p>
                <small class="text-muted">Posted by {{ $comment->user_name ?? 'Anonymous' }}</small>
            </div>
            
            {{-- دکمه حذف --}}
          @auth
            @can('articleOwner', $article)
                <form action="{{ route('articles.comment.remove', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>
            </form>
            @endcan
          @endauth
        </div>
    </div>
@empty
    <p class="text-danger">This article has no comments.</p>
@endforelse


{{-- Comment Form --}}
<section class="mt-5">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <div class="d-flex flex-start">
                <img class="rounded-circle shadow-1-strong me-3"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(21).webp"
                    alt="avatar" width="65" height="65" />
                <div class="w-100">
                    <h5 class="mb-3">Add a Comment</h5>

                    {{-- فرم ارسال کامنت --}}
                    <form action="{{ route('articles.comment.store', $article) }}" method="POST">
                        @csrf


                        {{-- نام کاربر --}}
                        <div class="form-outline mb-3">
                            <input type="text" name="user_name" class="form-control" placeholder="What is Your Name ?" required>
                        </div>

                        {{-- متن نظر --}}
                        <div class="form-outline mb-3">
                            <textarea class="form-control" name="text" rows="4" placeholder="What is your view?" required></textarea>
                        </div>

                        {{-- دکمه‌ها --}}
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Send <i class="fas fa-paper-plane ms-1"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


</div>

@endsection
