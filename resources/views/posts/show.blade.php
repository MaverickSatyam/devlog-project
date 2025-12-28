@extends('layout')

@section('content')
<article class="max-w-3xl mx-auto py-12">
    <nav class="mb-8 flex items-center text-sm text-gray-500">
        <a href="{{ route('posts.index') }}" class="hover:text-blue-600">Home</a>
        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg>
        <span class="text-gray-900 font-medium">Article</span>
    </nav>

    <header class="mb-12">
        <h1 class="text-5xl font-black text-gray-900 leading-tight mb-6">
            {{ $post->title }}
        </h1>
        
        <div class="flex items-center justify-between py-6 border-y border-gray-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xl">
                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-gray-900 font-bold">{{ $post->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }} • {{ ceil(str_word_count($post->content) / 200) }} min read</p>
                </div>
            </div>
            
            @if(auth()->id() === $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-bold hover:bg-gray-200 transition">
                    Edit Article
                </a>
            @endif
        </div>
    </header>

    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed font-serif" style="white-space: pre-line">
        {{ $post->content }}
    </div>
</article>
@guest
    <div class="mt-12 p-8 bg-gray-50 rounded-3xl text-center">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Enjoyed this interpretation?</h3>
        <p class="text-gray-500 mb-6 text-sm">Create your own account to start sharing your thoughts with the community.</p>
        <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold shadow-md">Join DevLog</a>
    </div>
@endguest
@endsection