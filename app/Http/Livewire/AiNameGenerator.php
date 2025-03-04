<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AiNameGenerator extends Component
{
    public $nameStyle = 'Auto';
    public $randomness = 'Medium';
    public $keywords = '';
    public $description = '';
    public $generatedNames = [];
    public $loading = false;
    public $errorMessage = '';

    public function generateNames()
    {
        $this->validate([
            'nameStyle' => 'required',
            'randomness' => 'required',
            'keywords' => 'required|min:2',
        ]);

        $this->loading = true;
        $this->errorMessage = '';
        $this->generatedNames = [];

        try {
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Prepare the prompt for the AI
            $prompt = "Generate unique names based on the following details:\n";
            $prompt .= "- Name style: {$this->nameStyle}\n";
            $prompt .= "- Randomness: {$this->randomness}\n";
            $prompt .= "- Keywords: {$this->keywords}\n";
            if (!empty($this->description)) {
                $prompt .= "- Business description: {$this->description}\n";
            }

            // API request to generate names
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
                // Parse the generated names into an array
                $namesText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                $this->generatedNames = explode("\n", trim($namesText));
            } else {
                $this->errorMessage = 'Failed to generate names. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.ai-name-generator');
    }
}
