<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PropertiesToJson extends Component
{
    use WithFileUploads;

    public $file;
    public $textInput;
    public $jsonOutput = '';

    public function convertPropertiesToJson()
    {
        if (!$this->file && !$this->textInput) {
            session()->flash('error', 'Please upload a .properties file or enter properties manually.');
            return;
        }

        $content = '';

        // Process file upload
        if ($this->file) {
            $path = $this->file->storeAs('temp', $this->file->getClientOriginalName());
            $content = Storage::get($path);
        }
        // Process manual text input
        elseif ($this->textInput) {
            $content = $this->textInput;
        }

        // Convert properties to JSON
        $lines = explode("\n", $content);
        $data = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (!$line || strpos($line, '#') === 0) continue; // Skip comments & empty lines
            
            $parts = preg_split('/[=:]/', $line, 2);
            if (count($parts) === 2) {
                $keys = explode('.', trim($parts[0]));
                $value = trim($parts[1]);

                $temp = &$data;
                foreach ($keys as $key) {
                    if (!isset($temp[$key])) {
                        $temp[$key] = [];
                    }
                    $temp = &$temp[$key];
                }
                $temp = $value;
            }
        }

        $this->jsonOutput = json_encode($data, JSON_PRETTY_PRINT);
    }

    public function render()
    {
        return view('livewire.properties-to-json');
    }
}
