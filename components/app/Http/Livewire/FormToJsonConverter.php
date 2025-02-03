<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormToJsonConverter extends Component
{
    public $formData = [];
    public $jsonOutput = '';

    public function addField()
    {
        $this->formData[] = ['key' => '', 'value' => ''];
    }

    public function removeField($index)
    {
        unset($this->formData[$index]);
        $this->formData = array_values($this->formData);
    }

    public function convertToJson()
    {
        $jsonArray = [];
        foreach ($this->formData as $field) {
            if (!empty($field['key'])) {
                $jsonArray[$field['key']] = $field['value'];
            }
        }
        $this->jsonOutput = json_encode($jsonArray, JSON_PRETTY_PRINT);
    }

    public function render()
    {
        return view('livewire.form-to-json-converter');
    }
}
