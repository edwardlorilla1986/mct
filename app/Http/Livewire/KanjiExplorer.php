<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class KanjiExplorer extends Component
{
    public $kanjiCategories = [
        'joyo' => 'Jōyō Kanji',
        'jinmeiyo' => 'Jinmeiyō Kanji',
        'heisig' => 'Heisig Kanji',
        'kyouiku' => 'Kyōiku Kanji',
        'grade-1' => 'Grade 1 Kanji',
        'grade-2' => 'Grade 2 Kanji',
        'grade-3' => 'Grade 3 Kanji',
        'grade-4' => 'Grade 4 Kanji',
        'grade-5' => 'Grade 5 Kanji',
        'grade-6' => 'Grade 6 Kanji',
        'all' => 'All Kanji'
    ];
    
    public $selectedCategory;
    public $kanjiList = [];
    public $kanjiCharacter;
    public $kanjiDetails = null;
    public $kanjiReading;
    public $readingResults = [];
    public $wordResults = [];

    // Fetch Kanji List by Category
    public function fetchKanjiList()
    {
        if (!$this->selectedCategory) return;

        $response = Http::get("https://kanjiapi.dev/v1/kanji/{$this->selectedCategory}");

        if ($response->successful()) {
            $this->kanjiList = $response->json();
        } else {
            $this->kanjiList = [];
        }
    }

    

    // Fetch Kanji by Reading
    public function fetchKanjiByReading()
    {
        if (!$this->kanjiReading) return;

        $response = Http::get("https://kanjiapi.dev/v1/reading/{$this->kanjiReading}");

        if ($response->successful()) {
            $this->readingResults = $response->json();
        } else {
            $this->readingResults = [];
        }
    }

    // Fetch Words Associated with Kanji
    public function fetchKanjiWords()
    {
        if (!$this->kanjiCharacter) return;

        $response = Http::get("https://kanjiapi.dev/v1/words/{$this->kanjiCharacter}");

        if ($response->successful()) {
            $this->wordResults = $response->json();
        } else {
            $this->wordResults = [];
        }
    }
    
    // Fetch Kanji Details
    public function fetchKanjiDetails($kanji)
    {
        $this->selectedKanji = $kanji;
        $response = Http::get("https://kanjiapi.dev/v1/kanji/{$kanji}");

        if ($response->successful()) {
            $this->kanjiDetails = $response->json();
        } else {
            $this->kanjiDetails = null;
        }
    }

    public function render()
    {
        return view('livewire.kanji-explorer');
    }
}
