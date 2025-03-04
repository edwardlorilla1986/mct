<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class HabitTracker extends Component
{
    public $habits = [];
    public $habitName;
    public $days = [];
    public $startDate;
    public $completion = [];

    protected $rules = [
        'habitName' => 'required|string|max:255',
        'startDate' => 'required|date',
    ];

    public function mount()
    {
        $this->completion = [];
    }

    public function addHabit()
    {
        $this->validate();

        $this->habits[] = [
            'name' => $this->habitName,
            'start_date' => $this->startDate,
            'days' => [],
        ];

        $this->reset(['habitName', 'startDate']);
    }

    public function toggleCompletion($habitIndex, $dayIndex)
    {
        $this->habits[$habitIndex]['days'][$dayIndex]['completed'] = 
            !$this->habits[$habitIndex]['days'][$dayIndex]['completed'];
    }

    public function generateDays($habitIndex)
    {
        $startDate = Carbon::parse($this->habits[$habitIndex]['start_date']);
        $days = [];

        for ($i = 0; $i < 7; $i++) {
            $days[] = [
                'date' => $startDate->copy()->addDays($i)->format('Y-m-d'),
                'completed' => false,
            ];
        }

        $this->habits[$habitIndex]['days'] = $days;
    }

    public function render()
    {
        return view('livewire.habit-tracker');
    }
}

?>
