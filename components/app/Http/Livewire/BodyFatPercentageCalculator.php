<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BodyFatPercentageCalculator extends Component
{
    public $gender;
    public $age;
    public $weight;
    public $height;
    public $waistCircumference;
    public $neckCircumference;
    public $hipCircumference; // For females
    public $bodyFatPercentage;

    protected $rules = [
        'gender' => 'required|in:male,female',
        'age' => 'required|numeric|min:1|max:120',
        'weight' => 'required|numeric|min:1',
        'height' => 'required|numeric|min:1',
        'waistCircumference' => 'required|numeric|min:1',
        'neckCircumference' => 'required|numeric|min:1',
        'hipCircumference' => 'required_if:gender,female|nullable|numeric|min:1',
    ];

    public function calculateBodyFatPercentage()
    {
        // Validate inputs
        $this->validate();

        // Check for invalid conditions
        if ($this->waistCircumference <= $this->neckCircumference || $this->height <= 0) {
            $this->bodyFatPercentage = null;
            session()->flash('error', 'Invalid inputs: waist must be greater than neck, and height must be greater than zero.');
            return;
        }

        // Perform calculation
        if ($this->gender === 'male') {
            // US Navy formula for males
            $result = 86.010 * log10($this->waistCircumference - $this->neckCircumference)
                      - 70.041 * log10($this->height) + 36.76;
        } else {
            // US Navy formula for females
            $result = 163.205 * log10($this->waistCircumference + $this->hipCircumference - $this->neckCircumference)
                      - 97.684 * log10($this->height) - 78.387;
        }

        // Handle NaN or Inf results
        if (is_nan($result) || is_infinite($result)) {
            $this->bodyFatPercentage = null;
            session()->flash('error', 'Calculation error: please check your inputs.');
        } else {
            $this->bodyFatPercentage = round($result, 2);
        }
    }

    public function render()
    {
        return view('livewire.body-fat-percentage-calculator');
    }
}
