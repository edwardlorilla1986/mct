<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SplitBillCalculator extends Component
{
    public $totalBill = 0;
    public $numPeople = 1;
    public $customSplits = [];
    public $perPersonCost = 0;
    public $remainingAmount = 0;

    public function mount()
    {
        $this->customSplits = array_fill(0, $this->numPeople, 0);
    }

    public function updatedNumPeople()
    {
        $this->customSplits = array_fill(0, $this->numPeople, 0);
    }

    public function calculateSplit()
    {
        // Validate inputs
        $this->validate([
            'totalBill' => 'required|numeric|min:0',
            'numPeople' => 'required|integer|min:1',
            'customSplits.*' => 'nullable|numeric|min:0',
        ]);

        $totalCustomSplit = array_sum($this->customSplits);
        $sharedAmount = $this->totalBill - $totalCustomSplit;

        if ($sharedAmount < 0) {
            $this->addError('customSplits', 'Custom splits exceed the total bill.');
            return;
        }

        $this->perPersonCost = $sharedAmount / $this->numPeople;
        $this->remainingAmount = $sharedAmount % $this->numPeople;
    }

    public function render()
    {
        return view('livewire.split-bill-calculator');
    }
}
