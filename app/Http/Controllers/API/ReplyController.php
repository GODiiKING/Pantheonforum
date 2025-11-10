<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(Post $post)
    {
        $replies = $post->replies()->with('user')->latest()->get();
        return ApiResponse::success($replies);
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $reply = $post->replies()->create([
            'user_id' => $request->user()->id,
            'content' => $validated['content'],
        ]);

        return ApiResponse::success($reply->load('user'), 201);
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $reply->update($validated);

        return ApiResponse::success($reply);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        
        $reply->delete();

        return ApiResponse::success(['message' => 'Reply deleted successfully']);
    }
}