<?php
namespace App\Http\Livewire;

use Livewire\Component;

class JsonFlattener extends Component
{
    public $jsonInput;
    public $flattenedJson;
    public $depth = '*'; // Default to flatten all levels
    public $separator = '.'; // Default separator
    
    public function flattenJson($data, $prefix = '', $depth = '*', &$result = [])
    {
        foreach ($data as $key => $value) {
            $newKey = $prefix ? $prefix . $this->separator . $key : $key;

            if (is_array($value) || is_object($value)) {
                if ($depth === '*' || $depth > 1) {
                    $this->flattenJson((array)$value, $newKey, $depth === '*' ? '*' : $depth - 1, $result);
                } else {
                    $result[$newKey] = json_encode($value);
                }
            } else {
                $result[$newKey] = $value;
            }
        }
    }

    public function processJson()
    {
        $this->flattenedJson = '';
        if (!empty($this->jsonInput)) {
            $jsonArray = json_decode($this->jsonInput, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $result = [];
                $this->flattenJson($jsonArray, '', $this->depth, $result);
                $this->flattenedJson = json_encode($result, JSON_PRETTY_PRINT);
            } else {
                $this->flattenedJson = 'Invalid JSON input';
            }
        }
    }

    public function render()
    {
        return view('livewire.json-flattener');
    }
}
