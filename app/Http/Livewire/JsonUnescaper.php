<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonUnescaper extends Component
{
    public $jsonInput = '';
    public $unescapedJson = '';
    public $prettify = true;
    public $useTabs = false;
    public $indentationSize = 2;

    public function updatedJsonInput()
    {
        try {
            // Remove backslashes before quotes
            $cleanJson = stripslashes(trim($this->jsonInput, '"'));
            $decodedJson = json_decode($cleanJson, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                if ($this->prettify) {
                    $indent = $this->useTabs ? "\t" : str_repeat(" ", $this->indentationSize);
                    $this->unescapedJson = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    $this->unescapedJson = str_replace("    ", $indent, $this->unescapedJson);
                } else {
                    $this->unescapedJson = json_encode($decodedJson, JSON_UNESCAPED_SLASHES);
                }
            } else {
                $this->unescapedJson = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->unescapedJson = 'Error processing JSON';
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->unescapedJson = '';
    }

    public function render()
    {
        return view('livewire.json-unescaper');
    }
}
