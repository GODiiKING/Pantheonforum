<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Topic $topic)
    {
        $posts = $topic->posts()->with(['user', 'replies'])->latest()->get();
        return ApiResponse::success($posts);
    }

    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $post = $topic->posts()->create([
            'user_id' => $request->user()->id,
            'content' => $validated['content'],
        ]);

        return ApiResponse::success($post->load('user'), 201);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return ApiResponse::success($post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        $post->delete();

        return ApiResponse::success(['message' => 'Post deleted successfully']);
    }
}