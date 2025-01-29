<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AiWorkoutGenerator extends Component
{
    public $goal = '';
    public $fitnessLevel = '';
    public $availableTime = 30; // Default to 30 minutes
    public $workoutPlan = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateWorkout()
    {
        $this->validate([
            'goal' => 'required|min:3',
            'fitnessLevel' => 'required',
            'availableTime' => 'required|numeric|min:10',
        ]);

        $this->loading = true;
        $this->errorMessage = '';
        $this->workoutPlan = '';

        try {
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Prepare the AI prompt
            $prompt = "Create a personalized workout plan based on the following details:\n";
            $prompt .= "- Goal: {$this->goal}\n";
            $prompt .= "- Fitness Level: {$this->fitnessLevel}\n";
            $prompt .= "- Available Time: {$this->availableTime} minutes\n";

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
                $this->workoutPlan = trim($response->json()['candidates'][0]['content']['parts'][0]['text']);
            } else {
                $this->errorMessage = 'Failed to generate the workout plan. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.ai-workout-generator');
    }
}
