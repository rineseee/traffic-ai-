<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::latest()->get(); // ose mund të filtroni sipas nevojës

        return view('admin.dashboard', compact('posts'));
    }
}
