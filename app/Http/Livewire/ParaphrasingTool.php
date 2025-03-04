<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ParaphrasingTool extends Component
{
    public $inputText = '';
    public $paraphrasedText = '';
    public $loading = false;
    public $errorMessage = '';

    public function paraphraseText()
    {
        $this->validate([
            'inputText' => 'required|min:10',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        // Cache key for storing paraphrased results
        $cacheKey = 'paraphrase_' . md5($this->inputText);

        if (Cache::has($cacheKey)) {
            $this->paraphrasedText = Cache::get($cacheKey);
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
                            ['text' => "Paraphrase the following text: {$this->inputText}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                // Extract the paraphrased text
                $this->paraphrasedText = $response->json()['candidates'][0]['content']['parts'][0]['text'];

                // Cache the result for future requests
                Cache::put($cacheKey, $this->paraphrasedText, now()->addHours(2));
            } else {
                $this->errorMessage = 'Failed to paraphrase the text. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.paraphrasing-tool');
    }
}
