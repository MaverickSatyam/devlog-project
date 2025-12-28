@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-gray-900 mb-2">
            {{ isset($post) ? 'Refine your thoughts' : 'Write something new' }}
        </h1>
        <p class="text-gray-500">Capture your ideas in our distraction-free editor.</p>
    </div>

    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" 
          method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1 px-2">Post Title</label>
            <input type="text" name="title" 
                value="{{ old('title', $post->title ?? '') }}" 
                placeholder="Enter title..." 
                class="w-full text-xl font-bold border-none focus:ring-0 placeholder-gray-200 px-2 py-1 text-gray-800"
                required>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-2 bg-gray-50/50 border-b border-gray-100">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Content Body</label>
            </div>
            <textarea name="content" rows="10" 
                    placeholder="Write your story here..." 
                    class="w-full border-none focus:ring-0 p-6 text-base text-gray-600 leading-relaxed resize-none"
                    required>{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Cover Image (Optional)</label>
                <div class="relative border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:bg-gray-50 transition">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="text-gray-400">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-xs">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                @if(isset($post) && $post->image)
                    <p class="mt-2 text-xs text-blue-500 font-medium italic">Current image: {{ basename($post->image) }}</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Visibility</label>
                    <p class="text-xs text-gray-500 mb-4">Drafts are only visible to you. Published posts are public.</p>
                </div>
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl">
                    <span class="text-sm font-bold text-gray-700">Make Public</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" 
                               {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 mt-8">
            <a href="{{ route('posts.index') }}" class="px-8 py-4 text-gray-500 font-bold hover:text-gray-900 transition">Discard</a>
            <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-full font-bold shadow-xl hover:bg-blue-600 transition-all active:scale-95">
                {{ isset($post) ? 'Update Article' : 'Publish Story' }}
            </button>
        </div>
    </form>
</div>
@endsection