@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">All Threads</h1>

    @foreach ($threads as $thread)
        <div class="mb-4 p-4 bg-white rounded shadow">
            <a href="{{ route('threads.show', $thread) }}" class="text-xl font-semibold text-blue-600 hover:underline">
                {{ $thread->title }}
            </a>
            <p class="text-sm text-gray-600 mt-1">Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}</p>
        </div>
    @endforeach
@endsection