<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonUrlDecoder extends Component
{
    public $encodedJsonInput = '';
    public $decodedJsonOutput = '';

    public function updatedEncodedJsonInput()
    {
        try {
            // Decode URL-encoded JSON
            $decodedString = urldecode($this->encodedJsonInput);

            // Validate JSON
            $jsonArray = json_decode($decodedString, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format after decoding');
            }

            // Pretty-print JSON
            $this->decodedJsonOutput = json_encode($jsonArray, JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $this->decodedJsonOutput = 'Invalid URL-encoded JSON format';
        }
    }

    public function clearInput()
    {
        $this->encodedJsonInput = '';
        $this->decodedJsonOutput = '';
    }

    public function render()
    {
        return view('livewire.json-url-decoder');
    }
}
