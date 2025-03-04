<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RandomCocktail extends Component
{
    public $cocktail;
    public $selectedLanguage = 'EN'; // Default language

    protected $languages = [
        'EN' => 'strInstructions',
        'ES' => 'strInstructionsES',
        'DE' => 'strInstructionsDE',
        'FR' => 'strInstructionsFR',
        'IT' => 'strInstructionsIT',
    ];

    public function mount()
    {
        $this->fetchCocktail();
    }

    public function fetchCocktail()
    {
        $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/random.php');

        if ($response->successful()) {
            $this->cocktail = $response->json()['drinks'][0] ?? null;
        }
    }

    public function setLanguage($lang)
    {
        if (array_key_exists($lang, $this->languages)) {
            $this->selectedLanguage = $lang;
        }
    }

    public function render()
    {
        return view('livewire.random-cocktail', [
            'languages' => $this->languages
        ]);
    }
}
