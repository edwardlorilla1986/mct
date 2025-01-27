<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PomodoroTimer extends Component
{
    public $timer = "25:00";
    public $completedPomodoros = 0;
    public $totalPomodoros = 4;
    public $newTask = '';
    public $tasks = [];

    protected $listeners = ['timerTick' => 'updateTimer'];

    public function startTimer()
    {
        $this->dispatchBrowserEvent('start-timer', ['duration' => 1500]); // 25 minutes in seconds
    }

    public function pauseTimer()
    {
        $this->dispatchBrowserEvent('pause-timer');
    }

    public function resetTimer()
    {
        $this->timer = "25:00";
        $this->dispatchBrowserEvent('reset-timer');
    }

    public function updateTimer($time)
    {
        $this->timer = $time;
        if ($time == "00:00") {
            $this->completedPomodoros++;
        }
    }

    public function addTask()
    {
        if (!empty($this->newTask)) {
            $this->tasks[] = ['id' => count($this->tasks) + 1, 'name' => $this->newTask, 'completed' => false];
            $this->newTask = '';
        }
    }

    public function toggleTaskCompletion($taskId)
    {
        foreach ($this->tasks as &$task) {
            if ($task['id'] == $taskId) {
                $task['completed'] = !$task['completed'];
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.pomodoro-timer');
    }
}
