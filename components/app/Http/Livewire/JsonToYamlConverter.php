<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class JsonToYamlConverter extends Component
{
    public $jsonInput = '';
    public $yamlOutput = '';

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Convert JSON to YAML format
                $this->yamlOutput = Yaml::dump($decodedJson, 4, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
            } else {
                $this->yamlOutput = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->yamlOutput = 'Error processing JSON';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->yamlOutput = '';
    }

    public function render()
    {
        return view('livewire.json-to-yaml-converter');
    }
}
