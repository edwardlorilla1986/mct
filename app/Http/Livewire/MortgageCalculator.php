<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MortgageCalculator extends Component
{
    public $loanAmount = 0;
    public $interestRate = 0; // Annual interest rate (in percentage)
    public $loanTerm = 0; // Loan term in years
    public $downPayment = 0;
    public $monthlyPayment = 0;
    public $totalInterest = 0;
    public $paymentSchedule = [];

    public function calculateMortgage()
    {
        $this->validate([
            'loanAmount' => 'required|numeric|min:0',
            'interestRate' => 'required|numeric|min:0',
            'loanTerm' => 'required|numeric|min:1',
            'downPayment' => 'required|numeric|min:0',
        ]);

        $principal = $this->loanAmount - $this->downPayment;
        $monthlyRate = ($this->interestRate / 100) / 12;
        $totalMonths = $this->loanTerm * 12;

        if ($monthlyRate > 0) {
            $this->monthlyPayment = $principal * $monthlyRate / (1 - pow(1 + $monthlyRate, -$totalMonths));
        } else {
            $this->monthlyPayment = $principal / $totalMonths;
        }

        $this->totalInterest = $this->monthlyPayment * $totalMonths - $principal;
        $this->generatePaymentSchedule($principal, $monthlyRate, $totalMonths);
    }

    public function generatePaymentSchedule($principal, $monthlyRate, $totalMonths)
    {
        $remainingBalance = $principal;
        $this->paymentSchedule = [];

        for ($i = 1; $i <= $totalMonths; $i++) {
            $interestPayment = $remainingBalance * $monthlyRate;
            $principalPayment = $this->monthlyPayment - $interestPayment;
            $remainingBalance -= $principalPayment;

            $this->paymentSchedule[] = [
                'month' => $i,
                'principal' => round($principalPayment, 2),
                'interest' => round($interestPayment, 2),
                'balance' => round(max($remainingBalance, 0), 2),
            ];
        }
    }

    public function render()
    {
        return view('livewire.mortgage-calculator');
    }
}
