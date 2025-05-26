<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created comment in storage.
     * POST /posts/{post}/comments
     */
    public function store(Request $request, Post $post)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'description' => 'required|string|min:3|max:1000',
        ]);

        $comment = new Comment([
            'description' => $validated['description']
        ]);
        $comment->user_id = Auth::id();

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    /**
     * Remove the specified comment from storage.
     * DELETE /posts/{post}/comments/{comment}
     * Laravel injects Post and Comment
     * models automatically due to nested
     * and route model binding.
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment deleted successfully.');
    }
}
