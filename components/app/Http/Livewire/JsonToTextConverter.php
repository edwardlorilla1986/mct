<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToTextConverter extends Component
{
    public $jsonInput = '';
    public $plainTextOutput = '';

    public function updatedJsonInput()
    {
        try {
            // Decode JSON input
            $jsonArray = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            // Convert JSON to text
            $this->plainTextOutput = $this->convertJsonToText($jsonArray);
        } catch (\Exception $e) {
            $this->plainTextOutput = 'Invalid JSON format';
        }
    }

    private function convertJsonToText($data, $prefix = '')
    {
        $result = '';
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value) || is_object($value)) {
                    $result .= $prefix . $key . "\n" . $this->convertJsonToText($value, $prefix . "  ");
                } else {
                    $result .= $prefix . $key . ' ' . $value . "\n";
                }
            }
        } elseif (is_object($data)) {
            foreach (get_object_vars($data) as $key => $value) {
                $result .= $prefix . $key . ' ' . $value . "\n";
            }
        } else {
            $result .= $prefix . $data . "\n";
        }
        return trim($result);
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->plainTextOutput = '';
    }

    public function render()
    {
        return view('livewire.json-to-text-converter');
    }
}
