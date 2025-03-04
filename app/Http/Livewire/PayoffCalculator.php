<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PayoffCalculator extends Component
{
    public $loanAmount = 0; // Total loan amount
    public $monthlyPayment = 0; // Current monthly payment
    public $interestRate = 0; // Annual interest rate (in percentage)
    public $timeToPayoff = 0; // Time to payoff in months
    public $acceleratedSchedule = [];

    public function calculatePayoff()
    {
        $this->validate([
            'loanAmount' => 'required|numeric|min:1',
            'monthlyPayment' => 'required|numeric|min:1',
            'interestRate' => 'required|numeric|min:0',
        ]);

        $monthlyRate = ($this->interestRate / 100) / 12;

        if ($monthlyPayment <= $loanAmount * $monthlyRate) {
            $this->addError('monthlyPayment', 'The monthly payment must be greater than the interest amount to pay off the loan.');
            return;
        }

        // Calculate the time to payoff using the loan amortization formula
        $this->timeToPayoff = ceil(log($this->monthlyPayment / ($this->monthlyPayment - $loanAmount * $monthlyRate)) / log(1 + $monthlyRate));

        // Generate accelerated payoff schedule
        $this->generateAcceleratedSchedule($monthlyRate);
    }

    public function generateAcceleratedSchedule($monthlyRate)
    {
        $balance = $this->loanAmount;
        $this->acceleratedSchedule = [];

        for ($i = 1; $i <= $this->timeToPayoff; $i++) {
            $interest = $balance * $monthlyRate;
            $principal = $this->monthlyPayment - $interest;
            $balance -= $principal;

            $this->acceleratedSchedule[] = [
                'month' => $i,
                'principal' => round($principal, 2),
                'interest' => round($interest, 2),
                'balance' => round(max($balance, 0), 2),
            ];

            if ($balance <= 0) {
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.payoff-calculator');
    }
}
