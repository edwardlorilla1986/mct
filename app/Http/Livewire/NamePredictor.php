<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class NamePredictor extends Component
{
    public $name;
    public $predictions = [];

    public function predictNationality()
    {
        if (!$this->name) {
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Please enter a name', 'type' => 'danger']);
            return;
        }

        $response = Http::get("https://api.nationalize.io/?name={$this->name}");

        if ($response->successful()) {
            $this->predictions = $response->json()['country'] ?? [];
        } else {
            $this->predictions = [];
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Failed to fetch data', 'type' => 'danger']);
        }
    }

    public function render()
    {
        return view('livewire.name-predictor');
    }
}
