<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PlasticUsageCalculator extends Component
{
    public $plasticItems = [
        ['name' => 'Plastic Bottles', 'usage' => 0, 'weight' => 0.05], // Weight in kg
        ['name' => 'Plastic Bags', 'usage' => 0, 'weight' => 0.01],
        ['name' => 'Straws', 'usage' => 0, 'weight' => 0.002],
        ['name' => 'Food Containers', 'usage' => 0, 'weight' => 0.1],
        ['name' => 'Other Items', 'usage' => 0, 'weight' => 0.05],
    ];

    public $totalPlasticWaste = 0;
    public $reductionTips = [
        "Switch to reusable water bottles.",
        "Carry reusable shopping bags.",
        "Say no to straws.",
        "Use glass or stainless steel food containers.",
        "Choose products with minimal plastic packaging."
    ];

    public function calculatePlasticWaste()
    {
        $this->totalPlasticWaste = collect($this->plasticItems)->sum(function ($item) {
            return $item['usage'] * $item['weight'];
        });
    }

    public function updatedPlasticItems()
    {
        $this->calculatePlasticWaste();
    }

    public function render()
    {
        return view('livewire.plastic-usage-calculator');
    }
}

?>