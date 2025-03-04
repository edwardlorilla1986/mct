<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToToml extends Component
{
    public $jsonInput = '';
    public $tomlOutput = '';
    public $errorMessage = '';

    public function updatedJsonInput()
    {
        $this->convertJsonToToml();
    }

    public function convertJsonToToml()
    {
        try {
            $decoded = json_decode($this->jsonInput, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg());
            }

            $this->tomlOutput = $this->convertToToml($decoded);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->tomlOutput = '';
            $this->errorMessage = 'Invalid JSON: ' . $e->getMessage();
        }
    }

    private function convertToToml(array $data, $prefix = '')
    {
        $toml = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $toml .= "[$key]\n" . $this->convertToToml($value, $key) . "\n";
            } else {
                $val = is_numeric($value) ? $value : '"' . addslashes($value) . '"';
                $toml .= "$key = $val\n";
            }
        }
        return $toml;
    }

    public function downloadToml()
    {
        return response()->streamDownload(function () {
            echo $this->tomlOutput;
        }, 'converted.toml');
    }

    public function render()
    {
        return view('livewire.json-to-toml');
    }
}

// Blade Template (resources/views/livewire/json-to-toml.blade.php)
?>
