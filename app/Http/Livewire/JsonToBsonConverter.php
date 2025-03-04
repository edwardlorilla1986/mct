<?php

namespace App\Http\Livewire;

use Livewire\Component;
use MongoDB\BSON\fromJSON;
use MongoDB\BSON\toJSON;
use MongoDB\BSON\toPHP;
use MongoDB\BSON\Binary;

class JsonToBsonConverter extends Component
{
    public $jsonInput = '';
    public $bsonOutput = '';
    public $bsonHexOutput = '';
    public $fileName = 'output.bson';
    
    public function updatedJsonInput()
    {
        try {
            // Convert JSON to BSON
            $bson = fromJSON($this->jsonInput);
            $this->bsonOutput = $bson;
            
            // Convert BSON to Hexadecimal Representation
            $this->bsonHexOutput = bin2hex($bson->__toString());

        } catch (\Exception $e) {
            $this->bsonOutput = 'Invalid JSON format';
            $this->bsonHexOutput = '';
        }
    }

    public function downloadBson()
    {
        $filePath = storage_path('app/' . $this->fileName);
        file_put_contents($filePath, $this->bsonOutput);
        
        return response()->download($filePath)->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.json-to-bson-converter');
    }
}
