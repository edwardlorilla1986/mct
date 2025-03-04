<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class YamlToJsonConverter extends Component
{
    public $yamlInput = '';
    public $jsonOutput = '';
    public $useTabs = false;
    public $indentationSize = 2;

    public function updatedYamlInput()
    {
        try {
            // Convert YAML to an array
            $yamlArray = Yaml::parse($this->yamlInput);

            // Apply Indentation Options
            $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
            if ($this->indentationSize > 0) {
                $options |= JSON_PRETTY_PRINT;
                $jsonString = json_encode($yamlArray, $options);
                if ($this->useTabs) {
                    $jsonString = str_replace("    ", "\t", $jsonString);
                } else {
                    $jsonString = str_replace("\t", str_repeat(" ", $this->indentationSize), $jsonString);
                }
            } else {
                $jsonString = json_encode($yamlArray, $options);
            }

            $this->jsonOutput = $jsonString;
        } catch (\Exception $e) {
            $this->jsonOutput = 'Invalid YAML';
        }
    }

    public function clearInput()
    {
        $this->yamlInput = '';
        $this->jsonOutput = '';
    }

    public function render()
    {
        return view('livewire.yaml-to-json-converter');
    }
}
