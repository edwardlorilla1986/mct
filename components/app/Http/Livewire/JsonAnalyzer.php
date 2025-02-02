<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonAnalyzer extends Component
{
    public $jsonInput;
    public $analysisResult;
    public $printGeneralInfo = true;
    public $printDataTypes = true;
    public $analyzeNestedData = 'all';
    public $nestedDepth = '';

    public function analyzeJson()
    {
        if (!$this->jsonInput) {
            $this->analysisResult = 'Invalid JSON input';
            return;
        }

        try {
            $data = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format");
            }

            $result = [];

            if ($this->printGeneralInfo) {
                $result['General JSON Info'] = $this->getGeneralJsonInfo($data);
            }

            if ($this->printDataTypes) {
                $result['Data Type Statistics'] = $this->getDataTypeStatistics($data);
            }

            if ($this->analyzeNestedData !== 'none') {
                $result['Nested Data Analysis'] = $this->getNestedDataInfo($data);
            }

            $this->analysisResult = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $this->analysisResult = "Error: " . $e->getMessage();
        }
    }

    private function getGeneralJsonInfo($data)
    {
        return [
            'Type' => is_array($data) ? (array_keys($data) === range(0, count($data) - 1) ? 'array' : 'object') : gettype($data),
            'Nested objects' => $this->hasNestedObjects($data),
            'Nested arrays' => $this->hasNestedArrays($data),
            'Depth' => $this->getJsonDepth($data),
        ];
    }

    private function getDataTypeStatistics($data)
    {
        $counts = [
            'Objects' => 0,
            'Arrays' => 0,
            'Strings' => 0,
            'Numbers' => 0,
            'Booleans' => 0,
            'Null' => 0,
            'Keys' => 0,
        ];
        $this->countDataTypes($data, $counts);
        return $counts;
    }

    private function countDataTypes($data, &$counts)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!is_numeric($key)) {
                    $counts['Keys']++;
                }
                if (is_array($value)) {
                    if (array_keys($value) === range(0, count($value) - 1)) {
                        $counts['Arrays']++;
                    } else {
                        $counts['Objects']++;
                    }
                    $this->countDataTypes($value, $counts);
                } elseif (is_string($value)) {
                    $counts['Strings']++;
                } elseif (is_numeric($value)) {
                    $counts['Numbers']++;
                } elseif (is_bool($value)) {
                    $counts['Booleans']++;
                } elseif (is_null($value)) {
                    $counts['Null']++;
                }
            }
        }
    }

    private function hasNestedObjects($data)
    {
        return is_array($data) && array_filter($data, 'is_array') !== [];
    }

    private function hasNestedArrays($data)
    {
        return is_array($data) && array_filter($data, fn($value) => is_array($value) && array_keys($value) === range(0, count($value) - 1)) !== [];
    }

    private function getJsonDepth($data, $depth = 1)
    {
        if (is_array($data)) {
            return 1 + max(array_map(fn($value) => $this->getJsonDepth($value, $depth + 1), $data), [0]);
        }
        return $depth;
    }

    private function getNestedDataInfo($data, $depth = 1)
    {
        if ($this->analyzeNestedData === 'specific' && $this->nestedDepth !== '') {
            $depthLevels = explode(',', $this->nestedDepth);
            $depthLevels = array_map('trim', $depthLevels);
            $allowedDepths = [];

            foreach ($depthLevels as $level) {
                if (strpos($level, '-') !== false) {
                    [$start, $end] = explode('-', $level);
                    $allowedDepths = array_merge($allowedDepths, range($start, $end));
                } else {
                    $allowedDepths[] = (int)$level;
                }
            }

            if (!in_array($depth, $allowedDepths)) {
                return [];
            }
        }

        if (is_array($data)) {
            $info = [];
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $info[] = [
                        'Depth' => $depth,
                        'Type' => array_keys($value) === range(0, count($value) - 1) ? 'array' : 'object',
                        'Parent' => $key,
                        'Key count' => count($value),
                        'Keys' => array_keys($value),
                    ];
                    $info = array_merge($info, $this->getNestedDataInfo($value, $depth + 1));
                }
            }
            return $info;
        }
        return [];
    }

    public function render()
    {
        return view('livewire.json-analyzer');
    }
}
