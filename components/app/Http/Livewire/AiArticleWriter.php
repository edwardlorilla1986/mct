<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AiArticleWriter extends Component
{
    public $keywords = '';
    public $generatedArticle = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateArticle()
    {
        $this->validate([
            'keywords' => 'required|min:3',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        // Cache key for storing generated articles
        $cacheKey = 'article_' . md5($this->keywords);

        if (Cache::has($cacheKey)) {
            $this->generatedArticle = Cache::get($cacheKey);
            $this->loading = false;
            return;
        }

        try {
            // Replace with your actual API key
            $apiKey = 'AIzaSyA7aXSrx_BJ6YMxuzxpOoxdDPDVjRE4mEg';

            // Send a request to the Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Write a article about: {$this->keywords}"],
                        ],
                    ],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (!empty($data['candidates'][0]['content']['parts'][0]['text'])) {
                    // Extract the generated text
                    $this->generatedArticle = $data['candidates'][0]['content']['parts'][0]['text'];

                    // Cache the result for 2 hours
                    Cache::put($cacheKey, $this->generatedArticle, now()->addHours(2));
                } else {
                    $this->errorMessage = 'The API did not return any content.';
                }
            } else {
                $this->errorMessage = 'Failed to generate article. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while generating the article: ' . $e->getMessage();
        }

        $this->loading = false;
    }
    public function render()
    {
        return view('livewire.ai-article-writer');
    }
}
