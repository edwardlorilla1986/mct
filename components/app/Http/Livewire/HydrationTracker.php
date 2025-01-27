<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HydrationTracker extends Component
{
    public $dailyGoal = 2000; // Default daily goal in milliliters
    public $waterIntakeRecords = [];
    public $newIntake = [
        'amount' => 0,
        'time' => '',
    ];
    public $totalIntake = 0;

    protected $rules = [
        'newIntake.amount' => 'required|numeric|min:1',
        'newIntake.time' => 'required|date_format:H:i',
    ];

    public function addIntake()
    {
        $this->validate();

        $this->waterIntakeRecords[] = [
            'amount' => $this->newIntake['amount'],
            'time' => $this->newIntake['time'],
        ];

        $this->calculateTotalIntake();
        $this->reset('newIntake');
    }

    public function calculateTotalIntake()
    {
        $this->totalIntake = collect($this->waterIntakeRecords)->sum('amount');
    }

    public function render()
    {
        $progress = min(100, ($this->totalIntake / $this->dailyGoal) * 100);

        return view('livewire.hydration-tracker', compact('progress'));
    }
}

?>