<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class JsonlToJson extends Component
{
    use WithFileUploads;

    public $jsonlFile;
    public $manualJsonl;
    public $convertedJson;

    public function convert()
    {
        $jsonArray = [];

        if ($this->jsonlFile) {
            // Process uploaded file
            $path = $this->jsonlFile->getRealPath();
            if ($file = fopen($path, "r")) {
                while (($line = fgets($file)) !== false) {
                    $jsonArray[] = json_decode($line, true);
                }
                fclose($file);
            }
        } elseif ($this->manualJsonl) {
            // Process manual input
            $lines = explode("\n", trim($this->manualJsonl));
            foreach ($lines as $line) {
                $jsonArray[] = json_decode(trim($line), true);
            }
        } else {
            session()->flash('error', 'Please upload a JSONL file or enter JSONL data manually.');
            return;
        }

        // Convert JSONL to JSON format
        $this->convertedJson = json_encode($jsonArray, JSON_PRETTY_PRINT);
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
        return view('livewire.jsonl-to-json');
    }
}
