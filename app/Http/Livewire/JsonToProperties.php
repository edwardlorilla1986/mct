<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToProperties extends Component
{
    public $jsonInput;
    public $propertiesOutput;
    public $keyValueSeparator = '=';
    public $objectKeySeparator = '.';
    public $indexFormat = 'brackets'; // 'dot', 'brackets', 'custom'
    public $customIndexSeparator = '_';
    public $customIndexWrapperLeft = '(';
    public $customIndexWrapperRight = ')';

    public function convertJsonToProperties()
    {
        if (!$this->jsonInput) {
            $this->propertiesOutput = 'Invalid JSON input';
            return;
        }

        try {
            $data = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format");
            }

            $properties = [];
            $this->flattenJson($data, '', $properties);
            $this->propertiesOutput = implode("\n", $properties);
        } catch (\Exception $e) {
            $this->propertiesOutput = "Error: " . $e->getMessage();
        }
    }

    private function flattenJson($data, $prefix, &$properties)
    {
        foreach ($data as $key => $value) {
            $newKey = $prefix ? $prefix . $this->objectKeySeparator . $key : $key;

            if (is_array($value)) {
                if ($this->isAssociativeArray($value)) {
                    $this->flattenJson($value, $newKey, $properties);
                } else {
                    foreach ($value as $index => $item) {
                        $indexKey = $this->formatArrayIndex($index);
                        $this->flattenJson($item, $newKey . $indexKey, $properties);
                    }
                }
            } else {
                $properties[] = $newKey . $this->keyValueSeparator . $value;
            }
        }
    }

    private function formatArrayIndex($index)
    {
        if ($this->indexFormat === 'dot') {
            return '.' . $index;
        } elseif ($this->indexFormat === 'brackets') {
            return '[' . $index . ']';
        } elseif ($this->indexFormat === 'custom') {
            return $this->customIndexWrapperLeft . $index . $this->customIndexWrapperRight;
        }
        return '.' . $index;
    }

    private function isAssociativeArray($array)
    {
        if (!is_array($array)) {
            return false;
        }
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function render()
    {
        return view('livewire.json-to-properties');
    }
}
