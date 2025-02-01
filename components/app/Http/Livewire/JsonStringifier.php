<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonStringifier extends Component
{
    public $jsonInput = '{
    "name": "David",
    "isStudent": true,
    "grade": 85,
    "subjects": [
        "Math",
        "Science"
    ]
}';
    public $stringifiedJson = '"{\n    \"name\": \"David\",\n    \"isStudent\": true,\n    \"grade\": 85,\n    \"subjects\": [\n        \"Math\",\n        \"Science\"\n    ]\n}"';

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Apply JSON.stringify equivalent with escaped characters
                $this->stringifiedJson = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                $this->stringifiedJson = str_replace(["\n", "\t", "\""], ["\\n", "\\t", "\\\""], $this->stringifiedJson);
                $this->stringifiedJson = '"' . $this->stringifiedJson . '"';
            } else {
                $this->stringifiedJson = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->stringifiedJson = 'Error processing JSON';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->stringifiedJson = '';
    }

    public function render()
    {
        return view('livewire.json-stringifier');
    }
}
