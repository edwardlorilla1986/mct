<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonUrlEncoder extends Component
{
    public $jsonInput = '{
  "temperature": 18.2,
  "conditions": "Partly cloudy",
  "humidity": 0.65,
  "wind": {
    "speed": 10,
    "direction": "NW"
  }
}';
    public $urlEncodedOutput = '%7B%0A%20%20%22%74%65%6D%70%65%72%61%74%75%72%65%22%3A%20%31%38%2E%32%2C%0A%20%20%22%63%6F%6E%64%69%74%69%6F%6E%73%22%3A%20%22%50%61%72%74%6C%79%20%63%6C%6F%75%64%79%22%2C%0A%20%20%22%68%75%6D%69%64%69%74%79%22%3A%20%30%2E%36%35%2C%0A%20%20%22%77%69%6E%64%22%3A%20%7B%0A%20%20%20%20%22%73%70%65%65%64%22%3A%20%31%30%2C%0A%20%20%20%20%22%64%69%72%65%63%74%69%6F%6E%22%3A%20%22%4E%57%22%0A%20%20%7D%0A%7D
';
    public $fullEscape = false;
    public $uppercaseEncoding = true;

    public function updatedJsonInput()
    {
        try {
            // Validate JSON
            $jsonString = json_encode(json_decode($this->jsonInput, true), JSON_PRETTY_PRINT);
            if (!$jsonString) {
                throw new \Exception('Invalid JSON format');
            }

            // Encode JSON to URL-safe format
            if ($this->fullEscape) {
                $encoded = '';
                for ($i = 0; $i < strlen($jsonString); $i++) {
                    $hex = strtoupper(dechex(ord($jsonString[$i])));
                    $encoded .= '%' . ($this->uppercaseEncoding ? $hex : strtolower($hex));
                }
            } else {
                $encoded = urlencode($jsonString);
            }

            $this->urlEncodedOutput = $encoded;
        } catch (\Exception $e) {
            $this->urlEncodedOutput = 'Invalid JSON format';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->urlEncodedOutput = '';
    }

    public function render()
    {
        return view('livewire.json-url-encoder');
    }
}
