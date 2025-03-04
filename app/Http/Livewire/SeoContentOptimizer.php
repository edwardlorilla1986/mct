<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SeoContentOptimizer extends Component
{
    public $content = '';
    public $focusKeyword = '';
    public $optimizationSuggestions = [];
    public $loading = false;
    public $errorMessage = '';

    public function analyzeContent()
    {
        $this->validate([
            'content' => 'required|min:20',
            'focusKeyword' => 'required|min:3',
        ]);

        $this->loading = true;
        $this->errorMessage = '';
        $this->optimizationSuggestions = [];

        try {
            // API request to analyze content
            $apiKey = env('GOOGLE_AI_API_KEY');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Analyze the following content for SEO with the focus keyword '{$this->focusKeyword}': {$this->content}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                // Parse the suggestions into an array
                $suggestionsText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                $this->optimizationSuggestions = explode("\n", trim($suggestionsText));
            } else {
                $this->errorMessage = 'Failed to analyze the content. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.seo-content-optimizer');
    }
}
