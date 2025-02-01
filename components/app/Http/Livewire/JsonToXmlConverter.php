<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleXMLElement;

class JsonToXmlConverter extends Component
{
    public $jsonInput = '';
    public $xmlOutput = '';
    public $useTabs = false;
    public $indentationSize = 2;
    public $addMetaTag = true;
    public $keepMinified = false;

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $xml = new SimpleXMLElement('<root/>');
                $this->arrayToXml($decodedJson, $xml);

                // Generate XML String
                $xmlString = $xml->asXML();

                // Add XML Meta Tag
                if ($this->addMetaTag) {
                    $xmlString = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n" . $xmlString;
                }

                // Format Indentation
                if (!$this->keepMinified) {
                    $dom = new \DOMDocument();
                    $dom->preserveWhiteSpace = false;
                    $dom->loadXML($xmlString);
                    $dom->formatOutput = true;

                    // Apply spaces or tabs
                    $xmlString = $dom->saveXML();
                    if ($this->useTabs) {
                        $xmlString = str_replace("    ", "\t", $xmlString);
                    } else {
                        $xmlString = str_replace("\t", str_repeat(" ", $this->indentationSize), $xmlString);
                    }
                } else {
                    $xmlString = str_replace(["\n", "\r", "  "], "", $xmlString);
                }

                $this->xmlOutput = $xmlString;
            } else {
                $this->xmlOutput = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->xmlOutput = 'Error processing JSON';
        }
    }

    private function arrayToXml($data, &$xml)
    {
        foreach ($data as $key => $value) {
            $key = is_numeric($key) ? "row-$key" : $key;
            if (is_array($value)) {
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->xmlOutput = '';
    }

    public function render()
    {
        return view('livewire.json-to-xml-converter');
    }
}
