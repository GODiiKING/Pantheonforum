<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pantheon Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4">
        <a href="{{ route('threads.index') }}">Enter Here!</a>
        @auth
            <a href="{{ route('threads.create') }}">New Thread</a>
        @endauth
    </nav>

    <h1 class="text-3xl font-bold text-center my-6">Welcome to Pantheon Forum</h1>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>