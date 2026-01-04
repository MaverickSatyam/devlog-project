<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="container mx-auto flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <a href="{{ route('posts.index') }}" class="flex ml-2 md:mr-24">
                        <span class="self-center sm:text-2xl whitespace-nowrap text-3xl font-black text-gray-900 tracking-tighter">DevLog</span>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <div class="hidden md:flex flex-col text-right mr-2">
                            <span class="text-sm font-medium text-gray-900">Good day, {{ explode(' ', auth()->user()->name)[0] }}</span>
                            <span class="text-xs text-gray-500">Author Account</span>
                        </div>
                        @if(!Route::is('posts.create') && !Route::is('posts.edit'))
                        <a href="{{ route('posts.create') }}" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full shadow-sm transition-all duration-200">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="hidden sm:inline">New Post</span>
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-gray-500 rounded-lg hover:bg-gray-100" title="Logout">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg">Sign in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Get started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="h-20"></div>

    <div class="container mx-auto px-4">

        @yield('content')
    </div>
    @auth
        @if(!Route::is('posts.create') && !Route::is('posts.edit'))
            <a href="{{ route('posts.create') }}" 
            class="fixed bottom-8 right-8 z-50 flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-full shadow-2xl hover:scale-105 active:scale-95 transition-all duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span class="font-bold tracking-wide">Write Post</span>
            </a>
        @endif
    @endauth
        @if(session('success'))
        <div id="toast" class="fixed top-24 right-8 z-50 bg-gray-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => { document.getElementById('toast').style.display = 'none'; }, 4000);
        </script>
        @endif
    <footer class="bg-white border-t border-gray-100 mt-20">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <a href="/" class="text-xl font-black text-gray-900 tracking-tighter">DevLog</a>
                <p class="text-sm text-gray-400 mt-2">Documenting the journey, one post at a time.</p>
            </div>
            
            <div class="flex items-center gap-8 text-sm font-bold text-gray-500">
                <a href="{{ route('posts.index') }}" class="hover:text-blue-600 transition">Feed</a>
                @guest
                    <a href="{{ route('login') }}" class="hover:text-blue-600 transition">Sign In</a>
                @else
                    <a href="{{ route('posts.create') }}" class="hover:text-blue-600 transition">Write</a>
                @endguest
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-gray-50 flex justify-between items-center">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} DevLog. Built with Laravel.</p>
            <div class="flex gap-4">
                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
                <div class="w-2 h-2 rounded-full bg-gray-200"></div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>