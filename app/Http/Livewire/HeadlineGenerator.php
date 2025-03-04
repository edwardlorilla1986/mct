<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class HeadlineGenerator extends Component
{
    public $keywords;
    public $tone = 'catchy';
    public $headlines = [];

    public function generateHeadline()
    {
        // Validate input
        $this->validate([
            'keywords' => 'required|string|max:255',
            'tone' => 'required|string',
        ]);

        // Call Gemini API to generate headlines
        $this->headlines = $this->getHeadlinesFromGemini($this->keywords, $this->tone);
    }

    private function getHeadlinesFromGemini($keywords, $tone)
    {
        $apiKey = env('GOOGLE_AI_API_KEY'); // Load API key from configuration or .env
        $prompt = "Generate 5 unique and catchy headlines for blog posts, articles, or videos using the keywords: '{$keywords}'. The tone should be '{$tone}'.";

        $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
            ]);
        
        $generatedText = $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
        \Log::info($response->json());
                \Log::info(array_filter(array_map('trim', explode("\n", $generatedText))));

        return array_filter(array_map('trim', explode("\n", $generatedText)));
    }

    public function render()
    {
        return view('livewire.headline-generator');
    }
}
