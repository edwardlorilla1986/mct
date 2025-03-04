<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HeartRateZoneCalculator extends Component
{
    public $age;
    public $restingHeartRate;
    public $zones = [];

    protected $rules = [
        'age' => 'required|numeric|min:1|max:120',
        'restingHeartRate' => 'required|numeric|min:30|max:120',
    ];

    public function calculateZones()
    {
        $this->validate();

        $maxHeartRate = 220 - $this->age;
        $heartRateReserve = $maxHeartRate - $this->restingHeartRate;

        $this->zones = [
            [
                'name' => 'Zone 1 (50-60%)',
                'min' => round($this->restingHeartRate + ($heartRateReserve * 0.5)),
                'max' => round($this->restingHeartRate + ($heartRateReserve * 0.6)),
            ],
            [
                'name' => 'Zone 2 (60-70%)',
                'min' => round($this->restingHeartRate + ($heartRateReserve * 0.6)),
                'max' => round($this->restingHeartRate + ($heartRateReserve * 0.7)),
            ],
            [
                'name' => 'Zone 3 (70-80%)',
                'min' => round($this->restingHeartRate + ($heartRateReserve * 0.7)),
                'max' => round($this->restingHeartRate + ($heartRateReserve * 0.8)),
            ],
            [
                'name' => 'Zone 4 (80-90%)',
                'min' => round($this->restingHeartRate + ($heartRateReserve * 0.8)),
                'max' => round($this->restingHeartRate + ($heartRateReserve * 0.9)),
            ],
            [
                'name' => 'Zone 5 (90-100%)',
                'min' => round($this->restingHeartRate + ($heartRateReserve * 0.9)),
                'max' => round($this->restingHeartRate + ($heartRateReserve * 1.0)),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.heart-rate-zone-calculator');
    }
}

?>