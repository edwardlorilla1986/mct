<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Base64ToJsonConverter extends Component
{
    public $base64Input = '';
    public $jsonOutput = '';

    public function updatedBase64Input()
    {
        try {
            // Remove Data URL prefix if present
            $base64Data = preg_replace('/^data:application\/json;base64,/', '', trim($this->base64Input));

            // Decode Base64
            $decodedJson = base64_decode($base64Data);

            // Validate JSON
            $jsonArray = json_decode($decodedJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid Base64 or JSON format');
            }

            // Pretty-print JSON
            $this->jsonOutput = json_encode($jsonArray, JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $this->jsonOutput = 'Invalid Base64 or JSON format';
        }
    }

    public function clearInput()
    {
        $this->base64Input = '';
        $this->jsonOutput = '';
    }

    public function render()
    {
        return view('livewire.base64-to-json-converter');
    }
}
