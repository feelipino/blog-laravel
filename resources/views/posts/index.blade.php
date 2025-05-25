@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>

        @auth
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
        @endauth

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($posts->isEmpty())
            <p>No posts yet.</p> {{-- Changed from Portuguese to English --}}
        @else
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                        {{-- Changed "Por:" to "By:" and ensured date format is common --}}
                        <p><small>By: {{ $post->user->username }} on {{ $post->created_at->format('Y-m-d H:i') }}</small></p>
                        <p>{{ Str::limit($post->description, 150) }}</p>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">View Post</a>
                    </li>
                @endforeach
            </ul>

            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
