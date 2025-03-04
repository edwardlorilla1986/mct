<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class KeywordResearchTool extends Component
{
    public $query;
    public $keywords = [];
    public $loading = false;

    public function generateKeywords()
{
    $this->validate([
        'query' => 'required|string|min:3',
    ]);

    $this->loading = true;

    try {
        $apiKey = env('GOOGLE_AI_API_KEY');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => "Generate a list of high-performing and relevant keywords for: {$this->query}"],
                    ],
                ],
            ],
        ]);

        $data = $response->json();

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            $this->keywords = array_filter(array_map('trim', explode("\n", $data['candidates'][0]['content']['parts'][0]['text'])));
        } else {
            $this->keywords = ['Error fetching keywords. Please try again.'];
        }
    } catch (\Exception $e) {
        $this->keywords = ['Error: ' . $e->getMessage()];
    }

    $this->loading = false;
}

    public function render()
    {
        return view('livewire.keyword-research-tool');
    }
}
