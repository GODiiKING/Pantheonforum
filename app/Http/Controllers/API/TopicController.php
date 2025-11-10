<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with(['user', 'tags'])->latest()->get();
        return ApiResponse::success($topics);
    }

    public function show(Topic $topic)
    {
        $topic->load(['user', 'posts.user', 'tags']);
        return ApiResponse::success($topic);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string',
        ]);

        $topic = $request->user()->topics()->create($validated);

        return ApiResponse::success($topic, 201);
    }

    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:50',
            'content' => 'sometimes|string',
        ]);

        $topic->update($validated);

        return ApiResponse::success($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        
        $topic->delete();

        return ApiResponse::success(['message' => 'Topic deleted successfully']);
    }

    public function attachTags(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $topic->tags()->sync($validated['tag_ids']);

        return ApiResponse::success($topic->load('tags'));
    }
}