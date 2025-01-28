<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AiStoryWriter extends Component
{
    public $prompt = '';
    public $story = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateStory()
    {
        $this->validate([
            'prompt' => 'required|min:5',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        try {
            // Replace with your actual API key
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Send a request to the Gemini API to generate the story
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Write a story based on the following prompt: {$this->prompt}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                $this->story = trim($response->json()['candidates'][0]['content']['parts'][0]['text']);

                // Save story to local storage via browser's JS
                $this->dispatchBrowserEvent('save-story', ['story' => $this->story]);
            } else {
                $this->errorMessage = 'Failed to generate the story. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.ai-story-writer');
    }
}
