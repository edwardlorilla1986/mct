<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonHighlighter extends Component
{
    public $jsonInput = '';
    public $showLineNumbers = true;
    public $showSpecialChars = false;
    public $matchBrackets = true;
    public $highlightActiveLine = true;

    public function updatedJsonInput()
    {
        $this->validateJson();
    }

    public function validateJson()
    {
        json_decode($this->jsonInput);
        if (json_last_error() !== JSON_ERROR_NONE) {
            session()->flash('error', 'Invalid JSON format.');
        }
    }

    public function render()
    {
        return view('livewire.json-highlighter');
    }
}
