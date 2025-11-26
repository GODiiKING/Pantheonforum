<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    // Show all threads
    public function index()
    {
        // Fetch threads, newest first, eager-load user and topic relationships
        $threads = Thread::latest()->with('user', 'topic')->get();

        // Render resources/views/threads/index.blade.php
        return view('threads.index', compact('threads'));
    }

    // Show form to create a new thread
    public function create()
    {
        // Fetch all topics for the dropdown in the form
        $topics = Topic::all();

        // Render resources/views/threads/create.blade.php
        return view('threads.create', compact('topics'));
    }

    // Store a new thread
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'title'     => 'required|string|max:255',
            'body'      => 'required|string',
            'topic_id'  => 'required|exists:topics,id', // must match a valid topic
        ]);

        // Create a new thread record in the database
        Thread::create([
            'title'    => $request->title,
            'body'     => $request->body,
            'user_id'  => auth()->id(),      // assign to logged-in user
            'topic_id' => $request->topic_id, // link to chosen topic
        ]);

        // Redirect back to threads list with a success message
        return redirect()->route('threads.index')->with('success', 'Thread created!');
    }

    // Show a single thread with replies and relationships
    public function show(Thread $thread)
    {
        // Eager-load related models: user, topic, and replies (with their users)
        $thread->load(['user', 'topic', 'replies.user']);

        // Render resources/views/threads/show.blade.php
        return view('threads.show', compact('thread'));
    }
}