<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvestmentReturnCalculator extends Component
{
    public $initialInvestment = 0;
    public $annualReturnRate = 0; // In percentage
    public $investmentDuration = 0; // In years
    public $finalValue = 0;

    public function calculateInvestmentReturn()
    {
        // Validate inputs
        $this->validate([
            'initialInvestment' => 'required|numeric|min:0',
            'annualReturnRate' => 'required|numeric|min:0',
            'investmentDuration' => 'required|numeric|min:1',
        ]);

        // Calculate compound interest
        $this->finalValue = $this->initialInvestment * pow((1 + $this->annualReturnRate / 100), $this->investmentDuration);
    }

    public function render()
    {
        return view('livewire.investment-return-calculator');
    }
}
