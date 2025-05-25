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
    public function store (Request $request, Post $post)
    {
        $this->authorize('create', Comment::class);

        $validatedData = $request->validate([
            'description' => 'required|string|max:1000',
        ]);

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

        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comentário excluído com sucesso.');
    }
}
