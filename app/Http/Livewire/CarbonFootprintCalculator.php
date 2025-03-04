<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarbonFootprintCalculator extends Component
{
    public $energyConsumption = 0; // Energy consumption in kWh
    public $travelDistance = 0; // Travel distance in kilometers or miles
    public $dietType = ''; // Diet type (e.g., vegetarian, meat-based)
    public $carbonEmissions = 0; // Total carbon emissions in tons

    public function calculateCarbonFootprint()
    {
        $this->validate([
            'energyConsumption' => 'required|numeric|min:0',
            'travelDistance' => 'required|numeric|min:0',
            'dietType' => 'required|string',
        ]);

        // Approximate emission factors
        $energyEmissionFactor = 0.0005; // tons CO2 per kWh
        $travelEmissionFactor = 0.00012; // tons CO2 per km
        $dietEmissionFactor = $this->getDietEmissionFactor();

        // Calculate emissions
        $energyEmissions = $this->energyConsumption * $energyEmissionFactor;
        $travelEmissions = $this->travelDistance * $travelEmissionFactor;
        $dietEmissions = $dietEmissionFactor;

        $this->carbonEmissions = $energyEmissions + $travelEmissions + $dietEmissions;
    }

    private function getDietEmissionFactor()
    {
        switch ($this->dietType) {
            case 'vegetarian':
                return 0.5; // Average annual emissions in tons CO2
            case 'vegan':
                return 0.3;
            case 'meat':
                return 1.5;
            default:
                return 0;
        }
    }

    public function render()
    {
        return view('livewire.carbon-footprint-calculator');
    }
}
