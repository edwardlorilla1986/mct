<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RandomMeal extends Component
{
    public $meal = null;
    public $loading = false;

    public function mount()
    {
        $this->fetchRandomMeal();
    }

    public function fetchRandomMeal()
    {
        $this->loading = true;

        // Fetch data from TheMealDB API
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/random.php');

        if ($response->successful() && isset($response->json()['meals'][0])) {
            $this->meal = $response->json()['meals'][0];
        }

        $this->loading = false;
    }

    public function getIngredients()
    {
        $ingredients = [];
        for ($i = 1; $i <= 20; $i++) {
            $ingredient = $this->meal["strIngredient{$i}"] ?? null;
            $measure = $this->meal["strMeasure{$i}"] ?? null;
            if (!empty($ingredient) && !empty(trim($ingredient))) {
                $ingredients[] = "{$measure} {$ingredient}";
            }
        }
        return $ingredients;
    }

    public function render()
    {
        return view('livewire.random-meal');
    }
}
