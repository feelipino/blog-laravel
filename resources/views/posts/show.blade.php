@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4 shadow">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">
                    By {{ $post->user->name }} · {{ $post->created_at->format('F j, Y') }}
                </span>

                    @can('update', $post)
                        <div>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <div class="post-description mb-4">
                    {{ $post->description }}
                </div>
            </div>
        </div>

        <!-- Comment Section -->
        <div class="card shadow">
            <div class="card-header bg-light">
                <h4 class="mb-0">Comments ({{ $post->comments->count() }})</h4>
            </div>
            <div class="card-body">
                @auth
                    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="form-label">Add a comment</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <div class="alert alert-info">
                        <a href="{{ route('login') }}">Log in</a> to leave a comment.
                    </div>
                @endauth

                <div class="comments-list">
                    @forelse($post->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        {{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}
                                    </h6>

                                    @can('delete', $comment)
                                        <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger border-0"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                                <p class="card-text">{{ $comment->description }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to all posts
            </a>
        </div>
    </div>
@endsection
