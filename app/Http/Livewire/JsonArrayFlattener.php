<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonArrayFlattener extends Component
{
    public $jsonInput = '';
    public $depth = '*';
    public $format = 'minified';
    public $flattenedJson = '';

    public function updatedJsonInput()
    {
        try {
            // Decode JSON input
            $jsonArray = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            // Flatten the JSON array
            $depthLevels = $this->parseDepth();
            $flattenedArray = $this->flattenArray($jsonArray, 1, $depthLevels);

            // Format JSON Output
            $this->flattenedJson = $this->formatJson($flattenedArray);
        } catch (\Exception $e) {
            $this->flattenedJson = 'Invalid JSON format';
        }
    }

    private function parseDepth()
    {
        return ($this->depth === '*') ? '*' : (int)$this->depth;
    }

    private function flattenArray($array, $currentDepth, $depthLevels)
    {
        $flattened = [];

        foreach ($array as $value) {
            if (is_array($value) && ($depthLevels === '*' || $currentDepth < $depthLevels)) {
                $flattened = array_merge($flattened, $this->flattenArray($value, $currentDepth + 1, $depthLevels));
            } else {
                $flattened[] = $value;
            }
        }

        return $flattened;
    }

    private function formatJson($array)
    {
        switch ($this->format) {
            case 'tabs':
                return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            case 'spaces':
                return json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            case 'minified':
            default:
                return json_encode($array);
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->flattenedJson = '';
    }

    public function render()
    {
        return view('livewire.json-array-flattener');
    }
}
