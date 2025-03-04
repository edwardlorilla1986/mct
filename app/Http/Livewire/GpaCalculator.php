<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GpaCalculator extends Component
{
    public $courses = []; // Stores grades and credit hours
    public $finalGPA = null; // Final GPA

    public function mount()
    {
        // Initialize with one course by default
        $this->courses = [
            ['grade' => null, 'creditHours' => null],
        ];
    }

    public function addCourse()
    {
        $this->courses[] = ['grade' => null, 'creditHours' => null];
    }

    public function removeCourse($index)
    {
        unset($this->courses[$index]);
        $this->courses = array_values($this->courses); // Reindex the array
    }

    public function calculateGPA()
    {
        $this->validate([
            'courses.*.grade' => 'required|numeric|min:0|max:4',
            'courses.*.creditHours' => 'required|numeric|min:0',
        ]);

        $totalGradePoints = 0;
        $totalCreditHours = 0;

        foreach ($this->courses as $course) {
            $totalGradePoints += $course['grade'] * $course['creditHours'];
            $totalCreditHours += $course['creditHours'];
        }

        if ($totalCreditHours > 0) {
            $this->finalGPA = $totalGradePoints / $totalCreditHours;
        } else {
            $this->finalGPA = 0;
        }
    }

    public function render()
    {
        return view('livewire.gpa-calculator');
    }
}
