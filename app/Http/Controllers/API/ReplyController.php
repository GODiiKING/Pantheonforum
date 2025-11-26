<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Thread;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(Thread $thread)
    {
        $replies = $thread->replies()->with('user')->latest()->get();
        return ApiResponse::success($replies);
    }

    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $reply = $thread->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        return ApiResponse::success($reply->load('user'), 201);
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $validated = $request->validate([
            'body' => 'required|string',
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