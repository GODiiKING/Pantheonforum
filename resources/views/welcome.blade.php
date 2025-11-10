<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4">
        <a href="{{ route('threads.index') }}">Speed my mom is kinda homeless</a>
        @auth
            <a href="{{ route('threads.create') }}">New Thread</a>
        @endauth
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>