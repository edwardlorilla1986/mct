<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StockRoiCalculator extends Component
{
    public $stocks = [];
    public $newStock = [
        'name' => '',
        'purchasePrice' => 0,
        'currentPrice' => 0,
        'shares' => 0,
    ];
    public $totalInvestment = 0;
    public $totalCurrentValue = 0;
    public $totalROI = 0;

    protected $rules = [
        'newStock.name' => 'required|string|max:255',
        'newStock.purchasePrice' => 'required|numeric|min:0',
        'newStock.currentPrice' => 'required|numeric|min:0',
        'newStock.shares' => 'required|numeric|min:0',
    ];

    public function addStock()
    {
        $this->validate();

        $this->stocks[] = [
            'name' => $this->newStock['name'],
            'purchasePrice' => $this->newStock['purchasePrice'],
            'currentPrice' => $this->newStock['currentPrice'],
            'shares' => $this->newStock['shares'],
            'investment' => $this->newStock['purchasePrice'] * $this->newStock['shares'],
            'currentValue' => $this->newStock['currentPrice'] * $this->newStock['shares'],
            'roi' => (($this->newStock['currentPrice'] - $this->newStock['purchasePrice']) / $this->newStock['purchasePrice']) * 100,
        ];

        $this->calculateTotals();
        $this->reset('newStock');
    }

    public function calculateTotals()
    {
        $this->totalInvestment = collect($this->stocks)->sum('investment');
        $this->totalCurrentValue = collect($this->stocks)->sum('currentValue');
        $this->totalROI = ($this->totalCurrentValue - $this->totalInvestment) / max(1, $this->totalInvestment) * 100;
    }

    public function render()
    {
        return view('livewire.stock-roi-calculator');
    }
}

?>
