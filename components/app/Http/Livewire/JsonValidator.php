<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonValidator extends Component
{
    public $jsonInput = '';
    public $validationMessage = '';
    public $isValid = null;

    public function updatedJsonInput()
    {
        try {
            json_decode($this->jsonInput, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->isValid = true;
                $this->validationMessage = 'Valid JSON';
            } else {
                $this->isValid = false;
                $this->validationMessage = 'Invalid JSON: ' . json_last_error_msg();
            }
        } catch (\Exception $e) {
            $this->isValid = false;
            $this->validationMessage = 'Error: ' . $e->getMessage();
        }
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->isValid = null;
        $this->validationMessage = '';
    }

    public function render()
    {
        return view('livewire.json-validator');
    }
}
