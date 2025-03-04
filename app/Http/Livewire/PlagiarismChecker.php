<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class PlagiarismChecker extends Component
{
    public $inputText;
    public $matchedSources = [];
    public $isLoading = false;

    protected $rules = [
        'inputText' => 'required|string|min:10|max:250',
    ];

    public function checkPlagiarism()
    {
        $this->validate();
        $this->isLoading = true;

        try {
            // Call plagiarism API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer 9898c145-5474-449c-83bc-abfa05e3c405',
            ])->post('https://api.copyleaks.com/v3/plagiarism/check', [
                'text' => $this->inputText,
            ]);

            if ($response->successful()) {
                $this->matchedSources = $response->json('results'); // Adjust based on API response structure
            } else {
                $this->addError('inputText', 'Failed to check plagiarism. Response: ' . $response->status());
            }
        } catch (\Exception $e) {
            $this->addError('inputText', 'An error occurred: ' . $e->getMessage());
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.plagiarism-checker');
    }
}
