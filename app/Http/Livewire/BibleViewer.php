<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class BibleViewer extends Component
{
    public $books = [];
    public $selectedBook;
    public $chapters = [];
    public $selectedChapter;
    public $verses = [];

    public function mount()
    {
        $this->fetchBooks();
    }

    // Fetch all books of the Bible
    public function fetchBooks()
    {
        $response = Http::get("https://bible-api.com/data/web");

        if ($response->successful()) {
            $this->books = $response->json()['books'];
        } else {
            $this->books = [];
        }
    }

    // Fetch chapters for the selected book
    public function fetchChapters()
    {
        if (!$this->selectedBook) return;

        $response = Http::get("https://bible-api.com/data/web/{$this->selectedBook}");

        if ($response->successful()) {
            $this->chapters = $response->json()['chapters'];
        } else {
            $this->chapters = [];
        }

        $this->verses = []; // Reset verses when selecting a new book
    }

    // Fetch verses for the selected chapter
    public function fetchVerses()
    {
        if (!$this->selectedBook || !$this->selectedChapter) return;

        $response = Http::get("https://bible-api.com/data/web/{$this->selectedBook}/{$this->selectedChapter}");

        if ($response->successful()) {
            $this->verses = $response->json()['verses'];
        } else {
            $this->verses = [];
        }
    }

    public function render()
    {
        return view('livewire.bible-viewer');
    }
}
