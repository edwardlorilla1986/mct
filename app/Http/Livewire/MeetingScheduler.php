<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class MeetingScheduler extends Component
{
    public $participants = [];
    public $timeZones = [];
    public $meetingTime;
    public $scheduledMeetings = [];
    public $participantName;
    public $participantTimeZone;
    public $rules;

    public function mount()
    {
        $this->timeZones = timezone_identifiers_list();

        // Generate rules dynamically
        $this->rules = [
            'participantName' => 'required|string|max:255',
            'participantTimeZone' => 'required|in:UTC,' . implode(',', $this->timeZones),
            'meetingTime' => 'required|date_format:Y-m-d\TH:i',
        ];
    }

    public function addParticipant()
    {
        $this->validate([
            'participantName' => 'required|string|max:255',
            'participantTimeZone' => 'required|in:' . implode(',', $this->timeZones),
        ]);

        $this->participants[] = [
            'name' => $this->participantName,
            'timeZone' => $this->participantTimeZone,
        ];

        $this->reset(['participantName', 'participantTimeZone']);
    }

    public function scheduleMeeting()
    {
        $this->validate(['meetingTime' => 'required|date_format:Y-m-d\TH:i']);

        $meetingInUTC = Carbon::createFromFormat('Y-m-d\TH:i', $this->meetingTime, 'UTC');

        $this->scheduledMeetings[] = [
            'timeUTC' => $meetingInUTC->format('Y-m-d H:i'),
            'participants' => collect($this->participants)->map(function ($participant) use ($meetingInUTC) {
                $participantTime = $meetingInUTC->copy()->setTimezone($participant['timeZone']);
                return [
                    'name' => $participant['name'],
                    'time' => $participantTime->format('Y-m-d H:i'),
                    'timeZone' => $participant['timeZone'],
                ];
            })->toArray(),
        ];

        $this->reset(['meetingTime', 'participants']);
    }

    public function render()
    {
        return view('livewire.meeting-scheduler');
    }
}


?>