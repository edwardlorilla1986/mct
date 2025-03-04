<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WaterFootprintCalculator extends Component
{
    public $habits = [
        ['name' => 'Shower (per minute)', 'usage' => 10, 'quantity' => 0],
        ['name' => 'Toilet Flush (per flush)', 'usage' => 6, 'quantity' => 0],
        ['name' => 'Dishwashing (per load)', 'usage' => 15, 'quantity' => 0],
        ['name' => 'Laundry (per load)', 'usage' => 50, 'quantity' => 0],
        ['name' => 'Drinking Water (per liter)', 'usage' => 1, 'quantity' => 0],
    ];

    public $totalWaterUsage = 0;

    public function calculateWaterUsage()
    {
        $this->totalWaterUsage = collect($this->habits)->sum(function ($habit) {
            return $habit['usage'] * $habit['quantity'];
        });
    }

    public function updatedHabits()
    {
        $this->calculateWaterUsage();
    }

    public function render()
    {
        return view('livewire.water-footprint-calculator');
    }
}

?>
