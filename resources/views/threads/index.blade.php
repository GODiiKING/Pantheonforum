{{-- Extend the base layout located at resources/views/layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Define the "content" section that will be injected into @yield('content') in the layout --}}
@section('content')

    {{-- Page heading --}}
    <h1 class="text-2xl font-bold mb-6">All Threads</h1>

    {{-- Loop through the $threads collection. If it's empty, show the @empty block --}}
    @forelse ($threads as $thread)
        <div class="mb-4 p-4 bg-white rounded shadow">
            
            {{-- Link to the thread detail page using the "threads.show" route --}}
            <a href="{{ route('threads.show', $thread) }}" 
               class="text-xl font-semibold text-blue-600 hover:underline">
                {{-- Display the thread title --}}
                {{ $thread->title }}
            </a>

            {{-- Show who posted the thread and when, using diffForHumans() for a human-readable timestamp --}}
            <p class="text-sm text-gray-600 mt-1">
                Posted by {{ $thread->user->name }} • {{ $thread->created_at->diffForHumans() }}
            </p>
        </div>
    @empty
        {{-- If there are no threads, display a friendly message with a link to create one --}}
        <p class="text-gray-600">
            No threads yet. Be the first to 
            <a href="{{ route('threads.create') }}" class="text-blue-600 hover:underline">
                start one
            </a>!
        </p>
    @endforelse

{{-- End of the "content" section --}}
@endsection