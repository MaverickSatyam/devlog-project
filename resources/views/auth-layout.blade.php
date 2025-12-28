<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Welcome' }} - DevLog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl shadow-gray-200/50 p-10 border border-gray-100">
        <div class="text-center mb-10">
            <a href="/" class="text-3xl font-black text-gray-900 tracking-tighter">DevLog</a>
            <p class="text-gray-400 mt-2 text-sm font-medium italic">{{ $subtitle }}</p>
        </div>
        
        @yield('content')
    </div>
</body>
</html>