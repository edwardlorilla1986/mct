<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InterestRateConverter extends Component
{
    public $rate;
    public $frequency = 'monthly'; // Default conversion frequency
    public $convertedRate;

    public function convertRate()
    {
        if (!$this->rate || $this->rate < 0) {
            $this->convertedRate = "Please enter a valid interest rate.";
            return;
        }

        // Conversion logic
        switch ($this->frequency) {
            case 'monthly':
                $this->convertedRate = round(($this->rate / 12), 2) . '% (Monthly)';
                break;
            case 'weekly':
                $this->convertedRate = round(($this->rate / 52), 2) . '% (Weekly)';
                break;
            case 'daily':
                $this->convertedRate = round(($this->rate / 365), 4) . '% (Daily)';
                break;
            default:
                $this->convertedRate = "Invalid frequency.";
        }
    }

    public function render()
    {
        return view('livewire.interest-rate-converter');
    }
}
