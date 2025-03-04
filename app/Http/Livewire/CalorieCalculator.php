<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CalorieCalculator extends Component
{
    public $age;
    public $gender;
    public $weight;
    public $height;
    public $activityLevel;
    public $calories;

    protected $rules = [
        'age' => 'required|integer|min:1|max:120',
        'gender' => 'required|in:male,female',
        'weight' => 'required|numeric|min:1',
        'height' => 'required|numeric|min:1',
        'activityLevel' => 'required|in:sedentary,light,moderate,active,very_active',
    ];

    public function calculateCalories()
    {
        $this->validate();

        // Calculate Basal Metabolic Rate (BMR) using the Harris-Benedict Equation
        if ($this->gender === 'male') {
            $bmr = 88.362 + (13.397 * $this->weight) + (4.799 * $this->height) - (5.677 * $this->age);
        } else {
            $bmr = 447.593 + (9.247 * $this->weight) + (3.098 * $this->height) - (4.330 * $this->age);
        }

        // Adjust BMR based on activity level
        $activityMultipliers = [
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9,
        ];

        $this->calories = $bmr * $activityMultipliers[$this->activityLevel];
    }

    public function render()
    {
        return view('livewire.calorie-calculator');
    }
}

?>