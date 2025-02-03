<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToFormData extends Component
{
    public $jsonInput = '';
    public $formDataOutput = '';

    public function convertJsonToFormData()
    {
        try {
            $jsonArray = json_decode($this->jsonInput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->formDataOutput = "❌ Invalid JSON format.";
                return;
            }

            $formData = http_build_query($jsonArray, '', '&');
            $this->formDataOutput = urldecode($formData); // Display readable format
        } catch (\Exception $e) {
            $this->formDataOutput = "❌ Error: " . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.json-to-form-data');
    }
}
