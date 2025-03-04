<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToCson extends Component
{
    public $jsonInput = '';
    public $csonOutput = '';
    public $errorMessage = '';

    public function updatedJsonInput()
    {
        $this->convertJsonToCson();
    }

    public function convertJsonToCson()
    {
        try {
            $decoded = json_decode($this->jsonInput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg());
            }

            $this->csonOutput = $this->convertToCson($decoded);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->csonOutput = '';
            $this->errorMessage = 'Invalid JSON: ' . $e->getMessage();
        }
    }

    private function convertToCson(array $data, $indent = 0)
    {
        $cson = '';
        $prefix = str_repeat('  ', $indent);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $cson .= "{$prefix}{$key}: \n" . $this->convertToCson($value, $indent + 1);
            } else {
                $value = is_numeric($value) ? $value : "'{$value}'";
                $cson .= "{$prefix}{$key}: {$value}\n";
            }
        }

        return $cson;
    }

    public function downloadCson()
    {
        return response()->streamDownload(function () {
            echo $this->csonOutput;
        }, 'converted.cson');
    }

    public function render()
    {
        return view('livewire.json-to-cson');
    }
}
