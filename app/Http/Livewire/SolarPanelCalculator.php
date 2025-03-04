<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SolarPanelCalculator extends Component
{
    public $averageMonthlyBill;
    public $sunHoursPerDay;
    public $panelEfficiency = 20; // Default efficiency in percentage
    public $systemSize; // kW
    public $totalCost;
    public $savingsPerYear;
    public $paybackPeriod;
    public $costPerKW = 1000; // Cost per kW of solar panels

    protected $rules = [
        'averageMonthlyBill' => 'required|numeric|min:1',
        'sunHoursPerDay' => 'required|numeric|min:1|max:12',
        'panelEfficiency' => 'required|numeric|min:10|max:25',
    ];

    public function calculate()
    {
        $this->validate();

        // Calculate system size needed
        $this->systemSize = round(($this->averageMonthlyBill / ($this->sunHoursPerDay * 30)) * (100 / $this->panelEfficiency), 2);

        // Calculate total cost
        $this->totalCost = $this->systemSize * $this->costPerKW;

        // Calculate yearly savings
        $this->savingsPerYear = $this->averageMonthlyBill * 12;

        // Calculate payback period
        $this->paybackPeriod = $this->totalCost / $this->savingsPerYear;
    }

    public function render()
    {
        return view('livewire.solar-panel-calculator');
    }
}

?>