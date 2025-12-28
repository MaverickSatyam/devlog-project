@extends('auth-layout', ['title' => 'Register', 'subtitle' => 'Create your author account'])

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-4">
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required 
               class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm">
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}" required 
               class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm">
        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Password</label>
        <input type="password" name="password" required 
               class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm">
        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mb-6">
        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Confirm Password</label>
        <input type="password" name="password_confirmation" required 
               class="w-full bg-gray-50 border-none focus:ring-2 focus:ring-blue-500/20 rounded-2xl p-4 text-sm">
    </div>

    <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-blue-600 transition-all active:scale-95">
        Register
    </button>

    <div class="mt-10 pt-6 border-t border-gray-50 text-center">
        <p class="text-xs text-gray-400 font-medium">Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline"> Login</a>
        </p>
    </div>
</form>
@endsection