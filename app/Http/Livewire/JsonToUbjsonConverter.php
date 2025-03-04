<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class JsonToUbjsonConverter extends Component
{
    use WithFileUploads;

    public $jsonFile;
    public $ubjsonOutput;

    public function convert()
    {
        if (!$this->jsonFile) {
            $this->ubjsonOutput = 'No file uploaded.';
            return;
        }

        // Read JSON file content
        $jsonData = file_get_contents($this->jsonFile->getRealPath());

        if (!$this->isValidJson($jsonData)) {
            $this->ubjsonOutput = 'Invalid JSON format.';
            return;
        }

        // Convert JSON to UBJSON
        $dataArray = json_decode($jsonData, true);
        $ubjsonData = $this->jsonToUbjson($dataArray);

        // Convert binary UBJSON to Base64 for display
        $this->ubjsonOutput = base64_encode($ubjsonData);
    }

    private function jsonToUbjson($data)
    {
        // UBJSON encoding logic (Basic Implementation)
        if (is_array($data)) {
            $ubjson = "{"; // Start UBJSON object
            foreach ($data as $key => $value) {
                $ubjson .= "S" . chr(strlen($key)) . $key . $this->jsonToUbjson($value);
            }
            return $ubjson . "}";
        } elseif (is_int($data)) {
            return "i" . pack("N", $data); // UBJSON Integer
        } elseif (is_float($data)) {
            return "d" . pack("d", $data); // UBJSON Float
        } elseif (is_bool($data)) {
            return $data ? "T" : "F"; // UBJSON Boolean
        } elseif (is_null($data)) {
            return "Z"; // UBJSON Null
        } else {
            return "S" . chr(strlen($data)) . $data; // UBJSON String
        }
    }

    private function isValidJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function render()
    {
        return view('livewire.json-to-ubjson-converter');
    }
}
