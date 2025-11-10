<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TopicController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ReplyController;
use App\Http\Controllers\API\TagController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public read-only routes
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{topic}', [TopicController::class, 'show']);
Route::get('/topics/{topic}/posts', [PostController::class, 'index']);
Route::get('/posts/{post}/replies', [ReplyController::class, 'index']);
Route::get('/tags', [TagController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Topics
    Route::post('/topics', [TopicController::class, 'store']);
    Route::patch('/topics/{topic}', [TopicController::class, 'update']);
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy']);
    Route::post('/topics/{topic}/tags', [TopicController::class, 'attachTags']);
    
    // Posts
    Route::post('/topics/{topic}/posts', [PostController::class, 'store']);
    Route::patch('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    
    // Replies
    Route::post('/posts/{post}/replies', [ReplyController::class, 'store']);
    Route::patch('/replies/{reply}', [ReplyController::class, 'update']);
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy']);
    
    // Tags
    Route::post('/tags', [TagController::class, 'store']);
});