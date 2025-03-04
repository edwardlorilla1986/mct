<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonStringHider extends Component
{
    public $jsonInput;
    public $encodedJson;
    public $encodingType = 'surrogate'; // Default encoding method
    public $hideKeys = false;
    public $hexCase = 'lower';
    public $indentation = '2';

    public function encodeJson()
    {
        try {
            $jsonData = json_decode($this->jsonInput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format.");
            }

            $this->encodedJson = json_encode($this->processEncoding($jsonData), JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $this->encodedJson = "❌ Error: " . $e->getMessage();
        }
    }

    private function processEncoding($data)
    {
        if (is_array($data)) {
            $encodedArray = [];
            foreach ($data as $key => $value) {
                $newKey = $this->hideKeys ? $this->encodeString($key) : $key;
                $encodedArray[$newKey] = is_array($value) ? $this->processEncoding($value) : $this->encodeString($value);
            }
            return $encodedArray;
        }
        return $this->encodeString($data);
    }

    private function encodeString($string)
    {
        if (!is_string($string)) return $string;

        switch ($this->encodingType) {
            case 'surrogate':
                return $this->toSurrogatePairs($string);
            case 'hex':
                return $this->toHexEncoding($string);
            case 'unicode':
                return $this->toUnicodeCodePoints($string);
            default:
                return $string;
        }
    }

    private function toSurrogatePairs($string)
    {
        return implode('', array_map(fn($char) => sprintf("\\u%04X", mb_ord($char, 'UTF-8')), mb_str_split($string)));
    }

    private function toHexEncoding($string)
    {
        return implode('', array_map(fn($char) => sprintf("\\x%s", strtoupper(bin2hex($char))), str_split($string)));
    }

    private function toUnicodeCodePoints($string)
    {
        return implode('', array_map(fn($char) => sprintf("\\u{%X}", mb_ord($char, 'UTF-8')), mb_str_split($string)));
    }

    public function render()
    {
        return view('livewire.json-string-hider');
    }
}
