<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NetWorthTracker extends Component
{
    public $assets = [];
    public $liabilities = [];
    public $newAsset = [
        'name' => '',
        'value' => 0,
    ];
    public $newLiability = [
        'name' => '',
        'value' => 0,
    ];
    public $totalAssets = 0;
    public $totalLiabilities = 0;
    public $netWorth = 0;

    protected $rules = [
        'newAsset.name' => 'required|string|max:255',
        'newAsset.value' => 'required|numeric|min:0',
        'newLiability.name' => 'required|string|max:255',
        'newLiability.value' => 'required|numeric|min:0',
    ];

    public function addAsset()
    {
        $this->validate([
            'newAsset.name' => 'required|string|max:255',
            'newAsset.value' => 'required|numeric|min:0',
        ]);

        $this->assets[] = [
            'name' => $this->newAsset['name'],
            'value' => $this->newAsset['value'],
        ];

        $this->calculateTotals();
        $this->reset('newAsset');
    }

    public function addLiability()
    {
        $this->validate([
            'newLiability.name' => 'required|string|max:255',
            'newLiability.value' => 'required|numeric|min:0',
        ]);

        $this->liabilities[] = [
            'name' => $this->newLiability['name'],
            'value' => $this->newLiability['value'],
        ];

        $this->calculateTotals();
        $this->reset('newLiability');
    }

    public function calculateTotals()
    {
        $this->totalAssets = collect($this->assets)->sum('value');
        $this->totalLiabilities = collect($this->liabilities)->sum('value');
        $this->netWorth = $this->totalAssets - $this->totalLiabilities;
    }

    public function render()
    {
        return view('livewire.net-worth-tracker');
    }
}

?>