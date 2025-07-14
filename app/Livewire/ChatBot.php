<?php

namespace App\Livewire;

use App\Models\TrafficLog;
use App\Models\TrafficStatus;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBot extends Component
{
    public $message = '';
    public $chatMessages = [];
    public $loading = false;

    public function sendMessage()
    {
        if (empty($this->message)) {
            return;
        }

        $this->loading = true;

        // Add user message to chat
        $this->chatMessages[] = [
            'role' => 'user',
            'content' => $this->message
        ];

        // Get relevant traffic data
        $latestTraffic = TrafficLog::with('station')
            ->latest('logged_at')
            ->take(5)
            ->get();

        $trafficStatus = TrafficStatus::latest()
            ->first();

        // Create system context
        $systemContext = "You are a helpful traffic assistant. Here's the current traffic data:\n";
        foreach ($latestTraffic as $log) {
            $systemContext .= "Station {$log->station->name}: {$log->vehicle_count} vehicles at {$log->logged_at}\n";
        }

        if ($trafficStatus) {
            $systemContext .= "\nCurrent traffic status: {$trafficStatus->status}";
        }

        // Prepare messages for OpenAI
        $messages = [
            ['role' => 'system', 'content' => $systemContext],
            ...$this->chatMessages
        ];

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
            ]);

            $this->chatMessages[] = [
                'role' => 'assistant',
                'content' => $response->choices[0]->message->content
            ];
        } catch (\Exception $e) {
            $this->chatMessages[] = [
                'role' => 'assistant',
                'content' => 'Sorry, I encountered an error while processing your request.'
            ];
        }

        $this->message = '';
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
