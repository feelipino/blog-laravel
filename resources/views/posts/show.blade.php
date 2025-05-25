@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-subtitle mb-2 text-muted">
                    By: {{ $post->user->username }} on {{ $post->created_at->format('Y-m-d H:i') }}
                </p>
                <p class="card-text">{{ $post->description }}</p>

                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit Post</a>
                @endcan

                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                    </form>
                @endcan
            </div>
        </div>

        <hr>

        <h2>Comments</h2>

        @if (session('success_comment'))
            <div class="alert alert-success">
                {{ session('success_comment') }}
            </div>
        @endif

        @auth
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Add a Comment</h5>
                    <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Write your comment here..." required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        @else
            <p><a href="{{ route('login') }}">Log in</a> to add a comment.</p>
        @endauth


        @if($post->comments->isEmpty())
            <p>No comments yet.</p>
        @else
            @foreach ($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->description }}</p>
                        <p class="card-subtitle mb-2 text-muted">
                            <small>By: {{ $comment->user->username }} on {{ $comment->created_at->format('Y-m-d H:i') }}</small>
                        </p>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
