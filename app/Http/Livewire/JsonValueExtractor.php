<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonValueExtractor extends Component
{
    public $jsonInput = '';
    public $depth = '*';
    public $separator = "\n";
    public $wrapQuotes = false;
    public $printComplex = true;
    public $extractedValues = '';

    public function updatedJsonInput()
    {
        try {
            // Decode JSON input
            $jsonArray = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            // Extract values based on depth
            $depthLevels = $this->parseDepth();
            $values = $this->extractValues($jsonArray, 1, $depthLevels);

            // Format values
            if ($this->wrapQuotes) {
                $values = array_map(fn($val) => "\"$val\"", $values);
            }

            // Join values with specified separator
            $this->extractedValues = implode($this->separator, $values);
        } catch (\Exception $e) {
            $this->extractedValues = 'Invalid JSON format';
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

    private function extractValues($data, $currentDepth, $depthLevels)
    {
        $values = [];

        if (is_array($data)) {
            foreach ($data as $value) {
                if ($depthLevels === '*' || in_array($currentDepth, $depthLevels)) {
                    if (is_array($value)) {
                        $values[] = $this->printComplex ? "[array]" : "";
                    } elseif (is_object($value)) {
                        $values[] = $this->printComplex ? "{object}" : "";
                    } else {
                        $values[] = $value;
                    }
                }

                if (is_array($value) || is_object($value)) {
                    $values = array_merge($values, $this->extractValues($value, $currentDepth + 1, $depthLevels));
                }
            }
        }

        return $values;
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->extractedValues = '';
    }

    public function render()
    {
        return view('livewire.json-value-extractor');
    }
}
