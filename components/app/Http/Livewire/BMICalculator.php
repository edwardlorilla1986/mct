<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BMICalculator extends Component
{
    public $height = 0; // Height in cm or meters
    public $weight = 0; // Weight in kg
    public $bmi = 0;
    public $classification = '';

    public function calculateBMI()
    {
        $this->validate([
            'height' => 'required|numeric|min:0.1',
            'weight' => 'required|numeric|min:0.1',
        ]);

        // Convert height from cm to meters if needed
        $heightInMeters = $this->height / 100;

        // Calculate BMI
        $this->bmi = $this->weight / ($heightInMeters * $heightInMeters);

        // Determine health classification
        $this->classification = $this->getClassification($this->bmi);
    }

    private function getClassification($bmi)
    {
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            return 'Normal weight';
        } elseif ($bmi >= 25 && $bmi < 29.9) {
            return 'Overweight';
        } else {
            return 'Obesity';
        }
    }

    public function render()
    {
        return view('livewire.b-m-i-calculator');
    }
}
