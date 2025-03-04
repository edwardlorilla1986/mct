<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class CsonToJson extends Component
{
    public $csonInput = '';
    public $jsonOutput = '';
    public $errorMessage = '';

    public function updatedCsonInput()
    {
        $this->convertCsonToJson();
    }

    public function convertCsonToJson()
    {
        try {
            // Convert CSON (YAML-like format) to JSON
            $decoded = Yaml::parse($this->csonInput);
            
            if (!is_array($decoded)) {
                throw new \Exception('Invalid CSON format.');
            }

            $this->jsonOutput = json_encode($decoded, JSON_PRETTY_PRINT);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->jsonOutput = '';
            $this->errorMessage = 'Invalid CSON: ' . $e->getMessage();
        }
    }

    public function downloadJson()
    {
        return response()->streamDownload(function () {
            echo $this->jsonOutput;
        }, 'converted.json');
    }

    public function render()
    {
        return view('livewire.cson-to-json');
    }
}

// Blade Template (resources/views/livewire/cson-to-json.blade.php)
?>
