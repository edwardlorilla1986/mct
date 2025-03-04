<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class DailyPlanner extends Component
{
    public $tasks = [];
    public $task;
    public $priority;
    public $time;

    protected $rules = [
        'task' => 'required|string|max:255',
        'priority' => 'required|in:low,medium,high',
        'time' => 'required|date_format:H:i',
    ];

    public function addTask()
    {
        $this->validate();

        $this->tasks[] = [
            'task' => $this->task,
            'priority' => $this->priority,
            'time' => $this->time,
            'completed' => false,
        ];

        $this->reset(['task', 'priority', 'time']);
    }

    public function markAsCompleted($index)
    {
        $this->tasks[$index]['completed'] = true;
    }

    public function removeTask($index)
    {
        unset($this->tasks[$index]);
        $this->tasks = array_values($this->tasks);
    }

    public function render()
    {
        $this->tasks = collect($this->tasks)->sortBy('time')->toArray();
        return view('livewire.daily-planner');
    }
}

?>