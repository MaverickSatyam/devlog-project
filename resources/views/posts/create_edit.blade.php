@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-gray-900 mb-2 tracking-tighter">
            {{ isset($post) ? 'Refine your thoughts' : 'Write something new' }}
        </h1>
        <p class="text-gray-500 font-medium">Capture your ideas in our distraction-free editor.</p>
    </div>

    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" 
          method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @if(isset($post)) @method('PUT') @endif

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 transition-all focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-200">
            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1 px-2">Post Title</label>
            <input type="text" name="title" 
                value="{{ old('title', $post->title ?? '') }}" 
                placeholder="Enter title..." 
                class="w-full text-xl font-bold border-none focus:ring-0 outline-none placeholder-gray-200 px-2 py-1 text-gray-800 bg-transparent"
                required>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-200">
            <div class="px-6 py-2 bg-gray-50/50 border-b border-gray-100">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Content Body</label>
            </div>
            <textarea name="content" rows="12" 
                    placeholder="Write your story here..." 
                    class="w-full border-none focus:ring-0 outline-none p-6 text-base text-gray-600 leading-relaxed resize-none bg-transparent"
                    required>{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Cover Image (Optional)</label>
                <div class="relative border-2 border-dashed border-gray-100 rounded-2xl p-6 text-center hover:bg-gray-50 transition-colors group">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="text-gray-400 group-hover:text-blue-500 transition-colors">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-xs font-bold uppercase tracking-tighter">Click to upload</p>
                    </div>
                </div>
                @if(isset($post) && $post->image)
                    <div class="mt-4 flex items-center gap-2 text-[10px] font-bold text-blue-500 bg-blue-50 px-3 py-1 rounded-full w-fit">
                        <span class="uppercase italic">Current:</span>
                        <span class="truncate max-w-[150px]">{{ basename($post->image) }}</span>
                    </div>
                @endif
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Visibility</label>
                    <p class="text-xs text-gray-500 mb-4 leading-relaxed">Drafts are private. Published posts appear in the global feed.</p>
                </div>
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-2xl border border-gray-100">
                    <span class="text-xs font-black text-gray-700 uppercase tracking-tight">Make Public</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" 
                               {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-6 pt-4">
            <a href="{{ route('posts.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-900 transition-colors">Discard</a>
            <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-full font-bold shadow-2xl shadow-gray-900/20 hover:bg-blue-600 hover:-translate-y-1 transition-all active:scale-95">
                {{ isset($post) ? 'Save Changes' : 'Publish Story' }}
            </button>
        </div>
    </form>
</div>
@endsection