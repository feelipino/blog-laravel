<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     * GET /posts
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     * GET /posts/create
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     * POST /posts
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a post.');
        }

        // Create new post with the authenticated user
        $post = Auth::user()->posts()->create($validatedData);

        // Redirect to the newly created post
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified post.
     * GET /posts/{post}
     */
    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     * GET /posts/{post}/edit
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     * PUT/PATCH /posts/{post}
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update($validatedData);

        // Redirect to the updated post
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     * DELETE /posts/{post}
     */
    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();

        // Redirect to the posts index
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
