<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $question = $request->input('question');

        if (empty($question)) {
            return response()->json(['error' => 'Pyetja është e zbrazët.'], 400);
        }

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Je një asistent për analizë trafiku në Kosovë.'],
                    ['role' => 'user', 'content' => $question],
                ],
            ]);

            $reply = $response->choices[0]->message->content ?? 'Asnjë përgjigje nga AI.';

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gabim në komunikimin me AI: ' . $e->getMessage()], 500);
        }
    }
}
