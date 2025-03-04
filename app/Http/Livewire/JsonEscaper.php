<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonEscaper extends Component
{
    public $jsonInput = '';
    public $escapedJson = '';
    public $wrapInQuotes = true;

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                // Convert JSON to a string with escaped quotes and new lines
                $escaped = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                $escaped = str_replace(["\n", "\""], ["\\n", "\\\""], $escaped);

                // Optionally wrap the output in double quotes
                $this->escapedJson = $this->wrapInQuotes ? '"' . $escaped . '"' : $escaped;
            } else {
                $this->escapedJson = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->escapedJson = 'Error processing JSON';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->escapedJson = '';
    }

    public function render()
    {
        return view('livewire.json-escaper');
    }
}
