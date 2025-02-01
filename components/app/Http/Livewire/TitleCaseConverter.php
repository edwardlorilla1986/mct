<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TitleCaseConverter extends Component
{
    public $inputText = '';
    public $convertedText = '';
    public $wordCount = 0;
    public $charCount = 0;
    public $sentenceCount = 0;
    public $whitespaceCount = 0;

    // List of words that should remain lowercase
    private $lowercaseWords = [
        'a', 'an', 'the', 'and', 'but', 'or', 'nor', 
        'as', 'at', 'by', 'for', 'in', 'of', 'on', 'per', 'to', 'via',
        'vs', 'vs.', 'v', 'v.'
    ];

    public function convertToTitleCase()
    {
        $words = explode(' ', strtolower($this->inputText));
        $titleCasedWords = [];

        foreach ($words as $index => $word) {
            if ($index === 0 || $index === count($words) - 1 || !in_array($word, $this->lowercaseWords)) {
                $titleCasedWords[] = ucfirst($word);
            } else {
                $titleCasedWords[] = $word;
            }
        }

        $this->convertedText = implode(' ', $titleCasedWords);

        $this->calculateStats();
    }

    public function calculateStats()
    {
        $this->wordCount = str_word_count($this->inputText);
        $this->charCount = strlen($this->inputText);
        $this->sentenceCount = substr_count($this->inputText, '.') + substr_count($this->inputText, '?') + substr_count($this->inputText, '!');
        $this->whitespaceCount = substr_count($this->inputText, ' ');
    }

    public function clearText()
    {
        $this->inputText = '';
        $this->convertedText = '';
        $this->wordCount = 0;
        $this->charCount = 0;
        $this->sentenceCount = 0;
        $this->whitespaceCount = 0;
    }

    public function render()
    {
        return view('livewire.title-case-converter');
    }
}
