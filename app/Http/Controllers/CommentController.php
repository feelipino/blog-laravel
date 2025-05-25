<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created comment in storage.
     * POST /posts/{post}/comments
     */
    public function store (Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a comment.');
        }

        $comment = new Comment($validatedData);
        $comment->user_id = Auth::id();

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment created successfully.');
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

        if (Auth::check() && Auth::id() === $comment->user_id /* || Auth::user()->isAdmin() */) {
            $comment->delete();
            return redirect()->route('posts.show', $post)
                ->with('success', 'Comment deleted successfully.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete a comment.');
        }

        return redirect()->route('posts.show', $post)
            ->with('error', 'You are not authorized to delete this comment.');
    }
}
