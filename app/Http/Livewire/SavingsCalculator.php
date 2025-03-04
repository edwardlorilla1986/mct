<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SavingsCalculator extends Component
{
    public $initialSavings = 0;
    public $monthlyContribution = 0;
    public $interestRate = 0;
    public $savingsDuration = 0;
    public $totalSavings = 0;
    public $interestEarned = 0;

    public function calculateSavings()
    {
        // Convert annual interest rate to monthly
        $monthlyRate = $this->interestRate / 12 / 100;

        // Calculate total savings with compound interest
        $months = $this->savingsDuration * 12;
        $this->totalSavings = $this->initialSavings * pow(1 + $monthlyRate, $months);

        for ($i = 1; $i <= $months; $i++) {
            $this->totalSavings += $this->monthlyContribution * pow(1 + $monthlyRate, $months - $i);
        }

        // Calculate interest earned
        $this->interestEarned = $this->totalSavings - ($this->initialSavings + $this->monthlyContribution * $months);
    }

    public function render()
    {
        return view('livewire.savings-calculator');
    }
}
