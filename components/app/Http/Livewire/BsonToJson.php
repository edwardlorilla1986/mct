<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BsonToJson extends Component
{
    use WithFileUploads;

    public $bsonFile;
    public $manualBson;
    public $convertedJson;

    public function convert()
    {
        $jsonData = null;

        if ($this->bsonFile) {
            // Read BSON file and convert to JSON
            $bsonData = file_get_contents($this->bsonFile->getRealPath());
            $jsonData = $this->bsonDecode($bsonData);
        } elseif ($this->manualBson) {
            // Handle Base64-encoded BSON input
            $decodedBson = base64_decode($this->manualBson);
            $jsonData = $this->bsonDecode($decodedBson);
        } else {
            session()->flash('error', 'Please upload a BSON file or enter BSON data manually.');
            return;
        }

        $this->convertedJson = json_encode($jsonData, JSON_PRETTY_PRINT);
    }

    private function bsonDecode($bsonData)
    {
        // Simple BSON to JSON conversion (basic parsing, not MongoDB-specific)
        $jsonArray = [];
        $offset = 0;
        
        while ($offset < strlen($bsonData)) {
            $length = unpack('V', substr($bsonData, $offset, 4))[1]; // Read BSON document length
            $jsonArray[] = substr($bsonData, $offset + 4, $length - 5); // Extract document content
            $offset += $length;
        }

        return $jsonArray;
    }

    public function downloadJson()
    {
        if (!$this->convertedJson) {
            return;
        }

        return response()->streamDownload(function () {
            echo $this->convertedJson;
        }, 'converted.json', [
            'Content-Type' => 'application/json',
        ]);
    }

    public function render()
    {
        return view('livewire.bson-to-json');
    }
}
