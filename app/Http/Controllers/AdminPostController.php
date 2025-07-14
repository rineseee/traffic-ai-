<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(), // admin po e shton
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Postimi u shtua me sukses.');
    }

    public function edit(Post $post)
    {
        // return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update($request->only('title', 'description'));

        return redirect()->route('admin.posts.index')->with('success', 'Postimi u përditësua.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Postimi u fshi.');
    }
}
