<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\TrafficService;


class UserController extends Controller
{
    // UserController.php ose HomeController.php
    public function dashboard(Request $request)
    {
        $query = $request->input('query');

        $postsQuery = Post::where('user_id', auth()->id());

        if ($query) {
            $postsQuery->where('title', 'like', '%' . $query . '%');
        }

        $posts = $postsQuery->get();

        return view('user.dashboard', [
            'posts' => $posts,
            'search' => $query,
            'hotspots' => TrafficService::getHotspots(),
            'statistics' => TrafficService::getStatistics(),
            'ai_suggestions' => TrafficService::getAISuggestions(),
            'ai_response' => session('ai_response')
        ]);
    }


}
