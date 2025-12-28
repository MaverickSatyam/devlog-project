@extends('layout')

@section('content')
<div class="relative overflow-hidden bg-white rounded-3xl mb-12 p-8 md:p-16 shadow-sm border border-gray-100">
    <div class="relative z-10 max-w-2xl">
        <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
            Share your <span class="text-blue-600">developer</span> journey.
        </h1>
        <p class="text-lg text-gray-600 mb-8">
            A clean, minimal space for developers to document code, share insights, and build a digital garden.
        </p>
        
        <form action="{{ route('posts.index') }}" method="GET" class="relative max-w-md group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full pl-11 pr-24 py-4 rounded-2xl border-none bg-gray-100 focus:bg-white focus:ring-2 focus:ring-blue-500/20 transition-all text-gray-700 placeholder-gray-400 shadow-sm" 
                placeholder="Search articles...">

            <div class="absolute inset-y-0 right-2 flex items-center gap-2">
                @if(request('search'))
                    <a href="{{ route('posts.index') }}" 
                    class="px-3 py-1.5 text-xs font-bold bg-gray-200 text-gray-600 rounded-xl hover:bg-gray-300 transition-colors">
                        Clear
                    </a>
                @endif
                <button type="submit" class="px-3 py-1.5 text-xs font-bold bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
                    Search
                </button>
            </div>
        </form>
    </div>
    <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 hidden lg:block">
        <div class="w-64 h-64 bg-blue-50 rounded-full filter blur-3xl"></div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($posts as $post)
        <article class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col">
            <div class="relative h-48 overflow-hidden">
                <div class="relative h-48 overflow-hidden">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        @php
                            // Create a unique but consistent color based on ID
                            $gradients = [
                                'bg-gradient-to-br from-blue-500 to-indigo-600',
                                'bg-gradient-to-br from-purple-500 to-pink-500',
                                'bg-gradient-to-br from-emerald-400 to-cyan-500',
                                'bg-gradient-to-br from-orange-400 to-red-500',
                                'bg-gradient-to-br from-slate-700 to-slate-900',
                            ];
                            $selected = $gradients[$post->id % count($gradients)];
                        @endphp
                        <div class="w-full h-full {{ $selected }} flex items-center justify-center p-8 transition-transform duration-500 group-hover:scale-110">
                            <span class="text-white text-xl md:text-2xl font-black opacity-30 select-none tracking-tighter text-center leading-none italic">
                                {{-- Option A: Show first 4 words for a "Title" feel --}}
                                {{ Str::words($post->title, 4, '...') }}
                                
                                {{-- Option B: Or use a very large single Initial for a 'Branded' look --}}
                                {{-- {{ strtoupper(substr($post->title, 0, 1)) }} --}}
                            </span>
                        </div>
                    @endif

                    @if(!$post->is_published)
                        <span class="absolute top-4 left-4 bg-black/50 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">Draft</span>
                    @endif
                </div>
                @if(!$post->is_published)
                    <span class="absolute top-4 left-4 bg-black/50 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">Draft</span>
                @endif
            </div>

            <div class="p-6 flex-grow">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $post->user->name }}</span>
                </div>
                
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors leading-tight">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </h3>
                <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ Str::limit($post->content, 120) }}</p>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <a href="{{ route('posts.show', $post->id) }}" class="text-sm font-bold text-blue-600 hover:text-blue-800">Read More →</a>
                
                @if(auth()->id() === $post->user_id)
                <div class="flex items-center gap-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </article>
    @empty
        <div class="col-span-full py-10 flex flex-col items-center text-center">

            @if(request('search'))
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No matches for "{{ request('search') }}"</h3>
                <p class="text-gray-500 mb-8 max-w-sm">We couldn't find any articles matching your search. Try different keywords or browse all posts.</p>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 transition">
                    View all posts
                </a>
            @else
                <h3 class="text-2xl font-bold text-gray-900 mb-2">The garden is empty</h3>
                @auth
                    <p class="text-gray-500 mb-8 max-w-sm">There are currently no published posts. Why not start the conversation yourself?</p>
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white text-base font-medium rounded-full shadow-lg hover:bg-blue-700 transition">
                        Create your first post
                    </a>
                @else
                    <p class="text-gray-500 mb-8 max-w-sm">No one has published anything here yet. Check back soon or join us to contribute.</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 bg-gray-900 text-white text-base font-medium rounded-full shadow-lg hover:bg-gray-800 transition">
                        Join the community
                    </a>
                @endauth
            @endif
        </div>
        
        @endforelse

        </div><div class="mt-8 mb-8">
            {{ $posts->links() }}
        </div>
@endsection