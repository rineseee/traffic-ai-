<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use OpenAI\Laravel\Facades\OpenAI;
class TrafficController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard', [
            'posts' => Post::where('user_id', auth()->id())->get()
        ]);
    }

    public function index()
    {
        $trafficStats = [
            'daily' => 3250,
            'weekly' => 24800,
            'monthly' => 98000,
        ];

        $hotspots = [
            [
                'location' => 'Rr. B – Prishtinë',
                'intensity' => 95,
                'time' => '07:30 - 09:00',
                'lat' => 42.6629,
                'lng' => 21.1655,
            ],
            [
                'location' => 'Autostrada R7',
                'intensity' => 88,
                'time' => '16:30 - 18:30',
                'lat' => 42.6400,
                'lng' => 20.9800,
            ],
            [
                'location' => 'Sheshi Zahir Pajaziti',
                'intensity' => 72,
                'time' => '12:00 - 13:30',
                'lat' => 42.6663,
                'lng' => 21.1622,
            ],
        ];

        return view('welcome', compact('trafficStats', 'hotspots'));
    }

    public function generateAIRecommendation($city)
    {
        return "Bazuar në analizën e trafikut për qytetin $city, orët më të ngarkuara janë nga ora 07:30 deri në 09:00 dhe 16:30 deri në 18:30. Rekomandohet të shmangni pikat kryesore në këto orare.";
    }

    public function submitAIQuestion(Request $request)
    {
        $request->validate([
            'ai_question' => 'required|string|max:500',
        ]);

        $question = $request->input('ai_question');

        // $response = "Po analizoj pyetjen tuaj: \"$question\"...\n";
        // $response .= "🧠 Sipas të dhënave aktuale, shmang Rrugën B gjatë mëngjesit. Alternativa: Rruga Muharrem Fejza.";

        dd(Post::all());

        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $question],
            ],
        ]);
        dd($result->choices[0]->message->content); // Debugging line to check the result structure

        //echo $result->choices[0]->message->content; // Hello! How can I assist you today?

        return back()->with('ai_response', $result->choices[0]->message->content);
    }
}
