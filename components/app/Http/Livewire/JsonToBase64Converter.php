<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToBase64Converter extends Component
{
    public $jsonInput = '';
    public $base64Output = '';
    public $chunkSize = 76; // Default chunk size
    public $useChunking = false;
    public $generateDataUrl = false;

    public function updatedJsonInput()
    {
        try {
            // Validate JSON
            $jsonString = json_encode(json_decode($this->jsonInput, true), JSON_PRETTY_PRINT);
            if (!$jsonString) {
                throw new \Exception('Invalid JSON format');
            }

            // Convert to Base64
            $base64 = base64_encode($jsonString);

            // Apply chunking if enabled
            if ($this->useChunking) {
                $base64 = trim(chunk_split($base64, $this->chunkSize, "\n"));
            }

            // Generate Data URL if enabled
            if ($this->generateDataUrl) {
                $base64 = "data:application/json;base64," . $base64;
            }

            $this->base64Output = $base64;

        } catch (\Exception $e) {
            $this->base64Output = 'Invalid JSON format';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->base64Output = '';
    }

    public function render()
    {
        return view('livewire.json-to-base64-converter');
    }
}
