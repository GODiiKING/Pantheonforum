@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Create a New Thread</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('threads.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block font-semibold">Title</label>
            <input type="text" name="title" id="title" class="w-full border rounded p-2" value="{{ old('title') }}">
        </div>

        <div>
            <label for="topic_id" class="block font-semibold">Topic</label>
            <select name="topic_id" id="topic_id" class="w-full border rounded p-2">
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="body" class="block font-semibold">Body</label>
            <textarea name="body" id="body" rows="6" class="w-full border rounded p-2">{{ old('body') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Post Thread
        </button>
    </form>
@endsection