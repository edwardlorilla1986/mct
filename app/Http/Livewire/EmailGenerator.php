<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class EmailGenerator extends Component
{
    public $inputDetails = '';
    public $generatedEmail = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateEmail()
    {
        $this->validate([
            'inputDetails' => 'required|min:10',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        // Cache key for storing generated emails
        $cacheKey = 'email_' . md5($this->inputDetails);

        if (Cache::has($cacheKey)) {
            $this->generatedEmail = Cache::get($cacheKey);
            $this->loading = false;
            return;
        }

        try {
            // Replace with your actual API key
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Send a request to the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Generate a professional email based on the following details: {$this->inputDetails}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                // Extract the generated email text
                $this->generatedEmail = $response->json()['candidates'][0]['content']['parts'][0]['text'];

                // Cache the result for future requests
                Cache::put($cacheKey, $this->generatedEmail, now()->addHours(2));
            } else {
                $this->errorMessage = 'Failed to generate the email. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.email-generator');
    }
}
