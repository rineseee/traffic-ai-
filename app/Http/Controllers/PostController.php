<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    // Vetëm për user-at e kyçur
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Shfaq postimet: për user shfaq të vetat, për admin të gjitha
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // merr të gjitha postimet me relacionin user
        return view('admin.posts.index', compact('posts'));
    }





    // Forma për krijim të postimit
    public function create()
    {
        return view('posts.create');
    }

    // Ruaj postim të ri
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'traffic_type' => 'required|string',
            'location' => 'required|string',
            'datetime' => 'required|date',
            'description' => 'required|string',
            'priority' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,  // jo content
            'traffic_type' => $request->traffic_type,
            'location' => $request->location,
            'datetime' => $request->datetime,
            'priority' => $request->priority,
            'user_id' => auth()->id(),

        ]);


        return redirect()->route('user.dashboard')->with('success', 'Raporti u krijua me sukses!');

    }

    // Forma për editim
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Vetëm autori ose admini mund ta editojë
        if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Nuk ke të drejtë ta editosh këtë postim.');
        }

        return view('posts.edit', compact('post'));
    }

    // Ruaj ndryshimet
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard')
            ->with('success', 'Postimi u përditësua me sukses!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Vetëm autori ose admini mund ta fshijë
        if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Nuk ke të drejtë ta fshish këtë postim.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Postimi u fshi me sukses!');
    }
    //per searchat
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('user_id', auth()->id())
            ->where('title', 'like', '%' . $query . '%')
            ->get();

        return view('user.dashboard', [ // <-- e ndryshuam nga 'dashboard' në 'user.dashboard'
            'posts' => $posts,
            'search' => $query,
        ]);
    }


}
