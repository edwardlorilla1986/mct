<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AiPersonalityQuizBuilder extends Component
{
    public $quizTopic = '';
    public $questionCount = 5;
    public $quiz = [];
    public $loading = false;
    public $errorMessage = '';

    public function generateQuiz()
    {
        $this->validate([
            'quizTopic' => 'required|min:5',
            'questionCount' => 'required|integer|min:1|max:20',
        ]);

        $this->loading = true;
        $this->errorMessage = '';
        $this->quiz = [];

        try {
            $apiKey = env('GOOGLE_AI_API_KEY');

            // Prepare the prompt for the AI
            $prompt = "Generate a personality quiz on the topic '{$this->quizTopic}' with {$this->questionCount} questions. Each question should have 4 options.";

            // API request to generate the quiz
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
                $quizText = $response->json()['candidates'][0]['content']['parts'][0]['text'];
                $this->quiz = $this->parseQuiz($quizText);
            } else {
                $this->errorMessage = 'Failed to generate the quiz. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }

    private function parseQuiz($quizText)
    {
        $quiz = [];
        $questions = explode("\n\n", $quizText);
        foreach ($questions as $questionBlock) {
            $lines = explode("\n", trim($questionBlock));
            if (count($lines) >= 5) {
                $quiz[] = [
                    'question' => array_shift($lines),
                    'options' => $lines,
                ];
            }
        }

        return $quiz;
    }

    public function render()
    {
        return view('livewire.ai-personality-quiz-builder');
    }
}
