<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StepCounter extends Component
{
    public $dailyGoal = 10000; // Default daily step goal
    public $steps = [];
    public $newSteps = [
        'date' => '',
        'count' => 0,
    ];
    public $totalSteps = 0;
    public $progress = 0;

    protected $rules = [
        'newSteps.date' => 'required|date',
        'newSteps.count' => 'required|numeric|min:1',
    ];

    public function addSteps()
    {
        $this->validate();

        $this->steps[] = [
            'date' => $this->newSteps['date'],
            'count' => $this->newSteps['count'],
        ];

        $this->calculateTotalSteps();
        $this->reset('newSteps');
    }

    public function calculateTotalSteps()
    {
        $this->totalSteps = collect($this->steps)->sum('count');
        $this->progress = min(100, ($this->totalSteps / $this->dailyGoal) * 100);
    }

    public function render()
    {
        return view('livewire.step-counter');
    }
}

?>