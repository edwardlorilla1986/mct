<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompoundInterestCalculator extends Component
{
    public $principal = 0; // Initial investment or deposit
    public $rate = 0; // Annual interest rate (percentage)
    public $frequency = 1; // Compounding frequency (e.g., annually, quarterly)
    public $time = 0; // Time period in years
    public $totalAmount = 0;
    public $interestEarned = 0;

    public function calculateCompoundInterest()
    {
        $this->validate([
            'principal' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'frequency' => 'required|integer|min:1',
            'time' => 'required|numeric|min:0',
        ]);

        // Convert rate to decimal
        $rateDecimal = $this->rate / 100;

        // Compound interest formula
        $this->totalAmount = $this->principal * pow((1 + $rateDecimal / $this->frequency), $this->frequency * $this->time);

        // Calculate interest earned
        $this->interestEarned = $this->totalAmount - $this->principal;
    }

    public function render()
    {
        return view('livewire.compound-interest-calculator');
    }
}
