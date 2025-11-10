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
        $threads = Thread::latest()->with('user', 'topic')->get();
        return view('threads.index', compact('threads'));
    }

    // Show form to create a new thread
    public function create()
    {
        $topics = Topic::all();
        return view('threads.create', compact('topics'));
    }

    // Store a new thread
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'topic_id' => 'required|exists:topics,id',
        ]);

        Thread::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
        ]);

        return redirect()->route('threads.index')->with('success', 'Thread created!');
    }

    // Show a single thread with replies and relationships
    public function show(Thread $thread)
    {
        $thread->load(['user', 'topic', 'replies.user']);
        return view('threads.show', compact('thread'));
    }
}