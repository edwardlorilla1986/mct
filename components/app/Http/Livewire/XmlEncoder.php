<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class XmlEncoder extends Component
{
    public $inputText = '';
    public $outputText = '';
    public $encodingMode = 'special_chars'; // Default encoding mode
    public $numericMode = false; // Toggle for numeric encoding

    // Encoding modes for different cases
    protected $modes = [
        'special_chars' => ENT_XML1, 
        'non_ascii' => ENT_QUOTES | ENT_XML1,
        'non_ascii_printable' => ENT_NOQUOTES | ENT_XML1,
        'extensive' => ENT_QUOTES | ENT_SUBSTITUTE | ENT_XML1,
    ];

    public function encodeXml()
    {
        $flags = $this->modes[$this->encodingMode] ?? ENT_XML1;

        if ($this->numericMode) {
            $this->outputText = mb_encode_numericentity($this->inputText, [0x80, 0xFFFF, 0, 0xFFFF], 'UTF-8');
        } else {
            $this->outputText = htmlspecialchars($this->inputText, $flags, 'UTF-8');
        }
    }

    public function render()
    {
        return view('livewire.xml-encoder');
    }
}
