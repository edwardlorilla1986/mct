<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FuelCostCalculator extends Component
{
    public $distance = 0; // Distance of the trip in miles or kilometers
    public $fuelEfficiency = 0; // Fuel efficiency in miles per gallon (MPG) or liters per 100km
    public $fuelPrice = 0; // Fuel price per gallon or liter
    public $totalFuelCost = 0;

    public function calculateFuelCost()
    {
        $this->validate([
            'distance' => 'required|numeric|min:0.1',
            'fuelEfficiency' => 'required|numeric|min:0.1',
            'fuelPrice' => 'required|numeric|min:0.1',
        ]);

        // Calculate fuel cost
        $fuelNeeded = $this->distance / $this->fuelEfficiency;
        $this->totalFuelCost = $fuelNeeded * $this->fuelPrice;
    }

    public function render()
    {
        return view('livewire.fuel-cost-calculator');
    }
}
