<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WorkoutPlanner extends Component
{
    public $workouts = [];
    public $newWorkout = [
        'name' => '',
        'type' => '',
        'duration' => 0, // in minutes
        'date' => '',
    ];
    public $workoutTypes = ['Cardio', 'Strength', 'Flexibility', 'Balance'];

    protected $rules = [
        'newWorkout.name' => 'required|string|max:255',
        'newWorkout.type' => 'required|in:Cardio,Strength,Flexibility,Balance',
        'newWorkout.duration' => 'required|numeric|min:1',
        'newWorkout.date' => 'required|date',
    ];

    public function addWorkout()
    {
        $this->validate();

        $this->workouts[] = [
            'name' => $this->newWorkout['name'],
            'type' => $this->newWorkout['type'],
            'duration' => $this->newWorkout['duration'],
            'date' => $this->newWorkout['date'],
        ];

        $this->reset('newWorkout');
    }

    public function render()
    {
        return view('livewire.workout-planner');
    }
}

?>