@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Blog Posts</h1>
            </div>
            <div class="col-md-4 text-end">
                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> New Post
                    </a>
                @endauth
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                By {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
                            </h6>
                            <p class="card-text">{{ Str::limit($post->description, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                    Read more
                                </a>
                                <span class="text-muted">
                                <i class="bi bi-chat-dots"></i> {{ $post->comments->count() }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No posts found. Be the first to create a post!
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
