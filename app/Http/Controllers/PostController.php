<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 1. Display list of posts
    public function index(Request $request)
    {
        $query = Post::query();

        // Logic: Show if it's Published OR if it belongs to the logged-in user
        $query->where(function ($q) {
            $q->where('is_published', true);
            if (auth()->check()) {
                $q->orWhere('user_id', auth()->id());
            }
        });

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    // 2. Show form to create new post
    public function create()
    {
        return view('posts.create_edit');
    }

    // 3. Store the new post in DB
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ]);

        $data = $request->all();
        // Explicitly handle the boolean
        $data['is_published'] = $request->has('is_published');

        // ASSIGN THE LOGGED IN USER ID
        $data['user_id'] = auth()->id();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Save file to "storage/app/public/posts"
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // 4. Show a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5. Show form to edit existing post
    public function edit(Post $post)
    {
        // Senior Tip: Ensure only the owner can edit
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.create_edit', compact('post'));
    }

    // 6. Update the post in DB
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        // Explicitly handle the boolean
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // 7. Delete the post
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
