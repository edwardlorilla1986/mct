<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class SpeedReadingTest extends Component
{
    public $passages = [];
    public $selectedPassage = null;
    public $startTime = null;
    public $endTime = null;
    public $readingSpeed = null;
    public $questions = [];
    public $answers = [];
    public $comprehensionScore = null;
    public $readingHistory = [];

    public function mount()
    {
        // Initialize passages (could also be fetched from a database)
        $this->passages = [
            [
                'id' => 1,
                'title' => 'The Wonders of Space',
                'content' => 'Space is vast and full of mysteries waiting to be discovered...',
                'questions' => [
                    ['id' => 1, 'question' => 'What is space full of?', 'options' => ['Stars', 'Mysteries', 'Aliens'], 'answer' => 'Mysteries'],
                ],
            ],
            [
                'id' => 2,
                'title' => 'The Beauty of Nature',
                'content' => 'Nature surrounds us with beauty, from mountains to oceans...',
                'questions' => [
                    ['id' => 1, 'question' => 'What surrounds us with beauty?', 'options' => ['Nature', 'Cities', 'Technology'], 'answer' => 'Nature'],
                ],
            ],
        ];
         $this->answers = [];
    }

    public function startTest($passageId)
    {
        $this->selectedPassage = collect($this->passages)->firstWhere('id', $passageId);
        $this->questions = $this->selectedPassage['questions'];
        $this->startTime = Carbon::now();
    }

    public function endTest()
{
    $this->endTime = Carbon::now();

    // Calculate reading speed
    $elapsedTime = $this->endTime->diffInSeconds($this->startTime);
    $wordCount = str_word_count($this->selectedPassage['content']);
    $this->readingSpeed = ($wordCount / $elapsedTime) * 60; // Words per minute

    // Calculate comprehension score
    $correctAnswers = 0;
    foreach ($this->questions as $index => $question) {
        // Check if the answer key exists before comparing
        if (isset($this->answers[$index]) && $this->answers[$index] === $question['answer']) {
            $correctAnswers++;
        }
    }
    $this->comprehensionScore = (count($this->questions) > 0)
        ? ($correctAnswers / count($this->questions)) * 100
        : 0;

    // Store progress
    $this->readingHistory[] = [
        'date' => Carbon::now()->toDateTimeString(),
        'speed' => $this->readingSpeed,
        'score' => $this->comprehensionScore,
    ];
}


    public function render()
    {
        return view('livewire.speed-reading-test');
    }
}
