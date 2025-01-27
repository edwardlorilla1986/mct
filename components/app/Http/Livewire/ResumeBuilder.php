<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ResumeBuilder extends Component
{
    public $name = '';
    public $email = '';
    public $experience = '';
    public $skills = '';
    public $education = '';
    public $generatedResume = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateResume()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'experience' => 'required|min:10',
            'skills' => 'required|min:5',
            'education' => 'required|min:5',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        // Cache key for storing generated resumes
        $cacheKey = 'resume_' . md5($this->name . $this->email . $this->experience . $this->skills . $this->education);

        if (Cache::has($cacheKey)) {
            $this->generatedResume = Cache::get($cacheKey);
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
                            ['text' => "Create a professional resume with the following details: Name: {$this->name}, Email: {$this->email}, Experience: {$this->experience}, Skills: {$this->skills}, Education: {$this->education}."],
                        ],
                    ],
                ],
            ]);

            if ($response->successful() && isset($response->json()['candidates'][0]['content']['parts'][0]['text'])) {
                // Extract the generated resume text
                $this->generatedResume = $response->json()['candidates'][0]['content']['parts'][0]['text'];

                // Cache the result for future requests
                Cache::put($cacheKey, $this->generatedResume, now()->addHours(2));
            } else {
                $this->errorMessage = 'Failed to generate the resume. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.resume-builder');
    }
}