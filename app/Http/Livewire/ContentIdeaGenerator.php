<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ContentIdeaGenerator extends Component
{
    public $keywords = '';
    public $generatedIdeas = [];
    public $loading = false;
    public $errorMessage = '';

    public function generateIdeas()
    {
        $this->validate([
            'keywords' => 'required|min:3',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        // Cache key for storing content ideas
        $cacheKey = 'content_ideas_' . md5($this->keywords);

        if (Cache::has($cacheKey)) {
            $this->generatedIdeas = Cache::get($cacheKey);
            $this->loading = false;
            return;
        }

        try {
            // Replace with your actual API key
            $apiKey =env('GOOGLE_AI_API_KEY');

            // Send a request to the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Suggest trending and engaging content ideas based on the following keywords: {$this->keywords}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                // Parse the generated ideas into a list
                $ideasText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                $this->generatedIdeas = explode("\n", trim($ideasText));

                // Cache the result for future requests
                Cache::put($cacheKey, $this->generatedIdeas, now()->addHours(2));
            } else {
                $this->errorMessage = 'Failed to generate content ideas. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.content-idea-generator');
    }
}
