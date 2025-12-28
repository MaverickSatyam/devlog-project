@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Post</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Content</label>
            <textarea name="content" rows="5" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ $post->content }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Current Image</label>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="h-32 object-cover rounded mb-2">
            @else
                <span class="text-gray-400 text-sm">No image uploaded.</span>
            @endif
            <label class="block text-gray-700 font-bold mb-2 mt-2">Change Image</label>
            <input type="file" name="image" class="w-full text-sm text-gray-500">
        </div>
        
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="is_published" value="1" class="mr-2" 
                {{ $post->is_published ? 'checked' : '' }}>
            <label class="text-gray-700 font-bold">Published</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Post</button>
        <a href="{{ route('posts.index') }}" class="text-gray-600 ml-4 hover:underline">Cancel</a>
    </form>
</div>
@endsection