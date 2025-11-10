@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $thread->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $thread->body }}</p>
        <p class="text-sm text-gray-500">
            Posted by <strong>{{ $thread->user->name }}</strong> in <em>{{ $thread->topic->name }}</em> • {{ $thread->created_at->diffForHumans() }}
        </p>
    </div>

    <h2 class="text-xl font-semibold mb-4">Replies</h2>

    @forelse ($thread->replies as $reply)
        <div class="bg-gray-50 p-4 rounded mb-3 border">
            <p>{{ $reply->body }}</p>
            <p class="text-sm text-gray-500 mt-2">— {{ $reply->user->name }}, {{ $reply->created_at->diffForHumans() }}</p>
        </div>
    @empty
        <p class="text-gray-600">No replies yet. Be the first to respond!</p>
    @endforelse

    @auth
        <form action="{{ route('replies.store', $thread) }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="body" class="block font-semibold">Your Reply</label>
                <textarea name="body" id="body" rows="4" class="w-full border rounded p-2" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Post Reply
            </button>
        </form>
    @endauth
@endsection