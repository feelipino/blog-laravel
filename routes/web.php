<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Home page
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Create all RESTful routes for the PostController
Route::resource('posts', PostController::class);

// Create Comment routes neasted under posts
Route::resource('posts.comments', CommentController::class)->only([
    'store', 'destroy'
]);
