<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonKeyExtractor extends Component
{
    public $jsonInput = '';
    public $depth = '*';
    public $separator = "\n";
    public $wrapQuotes = false;
    public $extractedKeys = '';

    public function updatedJsonInput()
    {
        try {
            // Decode JSON input
            $jsonArray = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            // Extract keys based on depth
            $depthLevels = $this->parseDepth();
            $keys = $this->extractKeys($jsonArray, 1, $depthLevels);

            // Format keys
            if ($this->wrapQuotes) {
                $keys = array_map(fn($key) => "\"$key\"", $keys);
            }

            // Join keys with specified separator
            $this->extractedKeys = implode($this->separator, $keys);
        } catch (\Exception $e) {
            $this->extractedKeys = 'Invalid JSON format';
        }
    }

    private function parseDepth()
    {
        if ($this->depth === '*') {
            return '*';
        }

        $levels = explode(',', str_replace(' ', '', $this->depth));
        $parsedLevels = [];

        foreach ($levels as $level) {
            if (strpos($level, '-') !== false) {
                list($start, $end) = explode('-', $level);
                $parsedLevels = array_merge($parsedLevels, range((int)$start, (int)$end));
            } else {
                $parsedLevels[] = (int)$level;
            }
        }

        return array_unique($parsedLevels);
    }

    private function extractKeys($data, $currentDepth, $depthLevels)
    {
        $keys = [];

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($depthLevels === '*' || in_array($currentDepth, $depthLevels)) {
                    $keys[] = $key;
                }

                if (is_array($value) || is_object($value)) {
                    $keys = array_merge($keys, $this->extractKeys($value, $currentDepth + 1, $depthLevels));
                }
            }
        }

        return $keys;
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->extractedKeys = '';
    }

    public function render()
    {
        return view('livewire.json-key-extractor');
    }
}
