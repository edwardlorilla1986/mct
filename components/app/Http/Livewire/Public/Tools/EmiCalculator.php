<?php

namespace App\Http\Livewire\Public\Tools;

use Livewire\Component;

class EmiCalculator extends Component
{
    public $principal;
    public $rate;
    public $tenure;
    public $emi;
    public $currency = 'USD'; // Default currency
    public $currencies = ['USD', 'EUR', 'INR', 'GBP', 'JPY']; // List of currencies

    public function calculateEMI()
    {
        if ($this->principal && $this->rate && $this->tenure) {
            $monthlyRate = ($this->rate / 12) / 100;
            $this->emi = ($this->principal * $monthlyRate * pow(1 + $monthlyRate, $this->tenure)) /
                         (pow(1 + $monthlyRate, $this->tenure) - 1);
        }
    }

    public function render()
    {
        return view('livewire.public.tools.emi-calculator');
    }
}
