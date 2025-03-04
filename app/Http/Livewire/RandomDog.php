<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class RandomDog extends Component
{
    public $dogImage;

    public function mount()
    {
        $this->fetchRandomDog();
    }

    public function fetchRandomDog()
    {
        $response = Http::get("https://dog.ceo/api/breeds/image/random");

        if ($response->successful()) {
            $this->dogImage = $response->json()['message'];
        } else {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Failed to fetch image', 'type' => 'danger']);
        }
    }

    public function render()
    {
        return view('livewire.random-dog');
    }
}
