<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class SleepTracker extends Component
{
    public $sleepRecords = [];
    public $newSleepRecord = [
        'date' => '',
        'sleepTime' => '',
        'wakeTime' => '',
    ];
    public $averageSleepDuration = 0;

    protected $rules = [
        'newSleepRecord.date' => 'required|date',
        'newSleepRecord.sleepTime' => 'required|date_format:H:i',
        'newSleepRecord.wakeTime' => 'required|date_format:H:i|after:newSleepRecord.sleepTime',
    ];

    public function addSleepRecord()
    {
        $this->validate();

        $sleepTime = Carbon::createFromFormat('H:i', $this->newSleepRecord['sleepTime']);
        $wakeTime = Carbon::createFromFormat('H:i', $this->newSleepRecord['wakeTime']);
        $duration = $sleepTime->diffInMinutes($wakeTime) / 60;

        $this->sleepRecords[] = [
            'date' => $this->newSleepRecord['date'],
            'sleepTime' => $this->newSleepRecord['sleepTime'],
            'wakeTime' => $this->newSleepRecord['wakeTime'],
            'duration' => $duration,
        ];

        $this->calculateAverageSleepDuration();
        $this->reset('newSleepRecord');
    }

    public function calculateAverageSleepDuration()
    {
        if (empty($this->sleepRecords)) {
            $this->averageSleepDuration = 0;
            return;
        }

        $totalDuration = collect($this->sleepRecords)->sum('duration');
        $this->averageSleepDuration = $totalDuration / count($this->sleepRecords);
    }

    public function render()
    {
        return view('livewire.sleep-tracker');
    }
}

?>