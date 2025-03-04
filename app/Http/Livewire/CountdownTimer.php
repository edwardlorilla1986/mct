<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class CountdownTimer extends Component
{
    public $events = [];
    public $eventName;
    public $eventDate;
    public $timers = [];

    protected $rules = [
        'eventName' => 'required|string|max:255',
        'eventDate' => 'required|date|after:now',
    ];

    public function addEvent()
    {
        $this->validate();

        $this->events[] = [
            'name' => $this->eventName,
            'date' => $this->eventDate,
        ];

        $this->reset(['eventName', 'eventDate']);
    }

    public function updateTimers()
    {
        $now = Carbon::now();
        $this->timers = collect($this->events)->map(function ($event) use ($now) {
            $eventDate = Carbon::parse($event['date']);
            $diff = $now->diff($eventDate);

            return [
                'name' => $event['name'],
                'timeRemaining' => sprintf('%d days, %d hours, %d minutes, %d seconds', 
                    $diff->days, $diff->h, $diff->i, $diff->s
                ),
                'expired' => $eventDate->isPast(),
            ];
        })->toArray();
    }

    public function render()
    {
        $this->updateTimers();

        return view('livewire.countdown-timer');
    }
}

?>