<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class JsonObfuscator extends Component
{
    public $jsonInput;
    public $obfuscatedJson;

    public function obfuscateJson()
    {
        if (!$this->jsonInput) {
            $this->obfuscatedJson = 'Invalid JSON input';
            return;
        }

        try {
            $data = json_decode($this->jsonInput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format");
            }

            // Obfuscate JSON keys and values
            $obfuscatedData = $this->obfuscateArray($data);

            $this->obfuscatedJson = json_encode($obfuscatedData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            $this->obfuscatedJson = "Error: " . $e->getMessage();
        }
    }

    private function obfuscateArray($data)
    {
        $obfuscated = [];

        foreach ($data as $key => $value) {
            // Obfuscate key
            $newKey = $this->obfuscateString($key);

            if (is_array($value)) {
                // Recursively obfuscate nested arrays
                $obfuscated[$newKey] = $this->obfuscateArray($value);
            } elseif (is_string($value)) {
                // Obfuscate string values
                $obfuscated[$newKey] = $this->obfuscateString($value);
            } else {
                // Keep numbers/booleans unchanged
                $obfuscated[$newKey] = $value;
            }
        }

        return $obfuscated;
    }

    private function obfuscateString($text)
    {
        $encoded = '';
        $length = mb_strlen($text, 'UTF-8');

        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');

            if (rand(0, 1)) {
                // Convert to surrogate pair escape sequence
                $encoded .= sprintf('\\u%04X', mb_ord($char, 'UTF-8'));
            } else {
                // Leave some characters as original
                $encoded .= $char;
            }
        }

        return $encoded;
    }

    public function render()
    {
        return view('livewire.json-obfuscator');
    }
}
