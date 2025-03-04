<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TomlToJson extends Component
{
    public $tomlInput = '';
    public $jsonOutput = '';
    public $errorMessage = '';

    public function updatedTomlInput()
    {
        $this->convertTomlToJson();
    }

    public function convertTomlToJson()
    {
        try {
            $parsedData = $this->parseToml($this->tomlInput);
            
            if (!is_array($parsedData)) {
                throw new \Exception('Invalid TOML format.');
            }

            $this->jsonOutput = json_encode($parsedData, JSON_PRETTY_PRINT);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->jsonOutput = '';
            $this->errorMessage = 'Invalid TOML: ' . $e->getMessage();
        }
    }

    private function parseToml($toml)
    {
        $lines = explode("\n", $toml);
        $result = [];
        $currentSection = '';
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (!$line || strpos($line, '#') === 0) continue;
            
            if (preg_match('/\[(.*?)\]/', $line, $matches)) {
                $currentSection = $matches[1];
                $result[$currentSection] = [];
            } elseif (strpos($line, '=') !== false) {
                list($key, $value) = array_map('trim', explode('=', $line, 2));
                $value = trim($value, '"');
                if (is_numeric($value)) $value = $value + 0;
                if ($currentSection) {
                    $result[$currentSection][$key] = $value;
                } else {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }

    public function downloadJson()
    {
        return response()->streamDownload(function () {
            echo $this->jsonOutput;
        }, 'converted.json');
    }

    public function render()
    {
        return view('livewire.toml-to-json');
    }
}

// Blade Template (resources/views/livewire/toml-to-json.blade.php)
?>
