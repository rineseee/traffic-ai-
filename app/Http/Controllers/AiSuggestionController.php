<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiSuggestionController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'ai_question' => 'required|string|max:1000',
        ]);

        $question = $request->input('ai_question');

        // Këtu do të integrohet logjika e AI-së - për momentin përgjigje statike
        $ai_response = "Kjo është përgjigjja shembull për pyetjen tuaj: \"$question\".\nIntegrimi i AI-së do të vijë së shpejti!";

        // Mund ta ridrejtojmë tek dashboard me përgjigjen
        // Për ta ruajtur në sesion ose direkt me with()
        return redirect()->route('dashboard')->with('ai_response', $ai_response);
    }
}
