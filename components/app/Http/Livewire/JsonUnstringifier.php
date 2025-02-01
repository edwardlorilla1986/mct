<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonUnstringifier extends Component
{
    public $jsonString = '"{\n  \"event\": {\n    \"title\": \"Movie Night\",\n    \"date\": \"Friday 13\",\n    \"time\": \"19:00\"\n  }\n}"';
    public $unstringifiedJson = '{
  "event": {
    "title": "Movie Night",
    "date": "Friday 13",
    "time": "19:00"
  }
}
';

    public function updatedJsonString()
    {
        try {
            // Remove outer quotes and decode escape sequences
            $cleanString = stripslashes(trim($this->jsonString, '"'));
            $decodedJson = json_decode($cleanString, true);
            
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->unstringifiedJson = json_encode($decodedJson, JSON_PRETTY_PRINT);
            } else {
                $this->unstringifiedJson = 'Invalid JSON String';
            }
        } catch (\Exception $e) {
            $this->unstringifiedJson = 'Error processing JSON';
        }
    }

    public function clearInput()
    {
        $this->jsonString = '';
        $this->unstringifiedJson = '';
    }

    public function render()
    {
        return view('livewire.json-unstringifier');
    }
}
