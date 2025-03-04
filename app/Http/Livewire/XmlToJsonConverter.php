<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleXMLElement;

class XmlToJsonConverter extends Component
{
    public $xmlInput = '';
    public $jsonOutput = '';
    public $useTabs = false;
    public $indentationSize = 2;

    public function updatedXmlInput()
    {
        try {
            // Remove XML version meta tag if present
            $xmlString = trim(preg_replace('/<\?xml.*?\?>/', '', $this->xmlInput));

            // Load XML and convert to JSON
            $xml = new SimpleXMLElement($xmlString);
            $jsonArray = json_decode(json_encode($xml), true);

            // Apply Indentation Options
            $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
            if ($this->indentationSize > 0) {
                $options |= JSON_PRETTY_PRINT;
                $jsonString = json_encode($jsonArray, $options);
                if ($this->useTabs) {
                    $jsonString = str_replace("    ", "\t", $jsonString);
                } else {
                    $jsonString = str_replace("\t", str_repeat(" ", $this->indentationSize), $jsonString);
                }
            } else {
                $jsonString = json_encode($jsonArray, $options);
            }

            $this->jsonOutput = $jsonString;
        } catch (\Exception $e) {
            $this->jsonOutput = 'Invalid XML';
        }
    }

    public function clearInput()
    {
        $this->xmlInput = '';
        $this->jsonOutput = '';
    }

    public function render()
    {
        return view('livewire.xml-to-json-converter');
    }
}
