<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class MetaDescriptionGenerator extends Component
{
    public $pageTitle = '';
    public $pageContent = '';
    public $generatedDescription = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateMetaDescription()
    {
        $this->validate([
            'pageTitle' => 'required|min:5',
            'pageContent' => 'required|min:20',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        try {
            // API request to generate meta description
            $apiKey = env('GOOGLE_AI_API_KEY');
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Generate a meta description for the page titled '{$this->pageTitle}' with the following content: {$this->pageContent}"],
                        ],
                    ],
                ],
            ]);
            \Log::info($response);
            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                $this->generatedDescription = trim($response->json()['candidates'][0]['content']['parts'][0]['text']);
            } else {
                $this->errorMessage = 'Failed to generate the meta description. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.meta-description-generator');
    }
}
