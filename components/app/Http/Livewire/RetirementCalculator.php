<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RetirementCalculator extends Component
{
    public $currentAge = 30;
    public $retirementAge = 65;
    public $monthlyExpenses = 2000;
    public $inflationRate = 2; // Annual inflation rate in %
    public $savings = 50000;
    public $totalRequiredSavings = 0;

    public function calculateRetirementSavings()
    {
        $yearsToRetirement = $this->retirementAge - $this->currentAge;
        $adjustedMonthlyExpenses = $this->monthlyExpenses * pow(1 + $this->inflationRate / 100, $yearsToRetirement);
        $adjustedAnnualExpenses = $adjustedMonthlyExpenses * 12;

        // Assuming 20 years of retirement duration
        $retirementDuration = 20;
        $this->totalRequiredSavings = $adjustedAnnualExpenses * $retirementDuration;

        // Subtract current savings to calculate additional savings needed
        $this->totalRequiredSavings -= $this->savings;
        if ($this->totalRequiredSavings < 0) {
            $this->totalRequiredSavings = 0; // User already has enough savings
        }
    }

    public function render()
    {
        return view('livewire.retirement-calculator');
    }
}
