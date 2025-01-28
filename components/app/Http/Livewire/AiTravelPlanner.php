<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AiTravelPlanner extends Component
{
    public $destination = '';
    public $preferences = '';
    public $budget = '';
    public $itinerary = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateItinerary()
    {
        $this->validate([
            'destination' => 'required|min:3',
            'preferences' => 'required|min:5',
            'budget' => 'required|numeric|min:1',
        ]);

        $this->loading = true;
        $this->errorMessage = '';
        $this->itinerary = '';

        try {
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Prepare the AI prompt
            $prompt = "Plan a travel itinerary for the following details:\n";
            $prompt .= "- Destination: {$this->destination}\n";
            $prompt .= "- Preferences: {$this->preferences}\n";
            $prompt .= "- Budget: \${$this->budget}\n";

            // Send API request
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

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                $this->itinerary = trim($response->json()['candidates'][0]['content']['parts'][0]['text']);
            } else {
                $this->errorMessage = 'Failed to generate the itinerary. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.ai-travel-planner');
    }
}
