@extends('auth-layout', ['title' => 'Login', 'subtitle' => 'Welcome back to the feed.'])

@section('content')
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-xl text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                   class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm @error('email') ring-2 ring-red-500 @enderror">
            @error('email') <p class="text-red-500 text-[10px] mt-2 px-1 font-bold italic uppercase tracking-wider">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Password</label>
            <input id="password" type="password" name="password" required 
                   class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm">
        </div>

        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="flex items-center text-xs text-gray-400 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded-md border-gray-200 text-blue-600 focus:ring-blue-500/20 mr-2">
                Remember me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">Forgot Password?</a>
            @endif
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-600 transition-all active:scale-95">
            Sign In
        </button>
    </form>

    <div class="mt-10 pt-6 border-t border-gray-50 text-center">
        <p class="text-xs text-gray-400 font-medium">Don't have an account? 
            <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Register</a>
        </p>
    </div>

@endsection