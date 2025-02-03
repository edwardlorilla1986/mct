<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToTable extends Component
{
    public $jsonInput = '[
    {"name": "Alice", "age": 25, "email": "alice@example.com"},
    {"name": "Bob", "age": 30, "email": "bob@example.com"}
]';
    public $tableData = [];
    public $errorMessage = '';

    public function updatedJsonInput()
    {
        $this->parseJson();
    }

    public function parseJson()
    {
        try {
            $decoded = json_decode($this->jsonInput, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg());
            }

            if (!is_array($decoded)) {
                throw new \Exception('JSON must be an object or an array of objects.');
            }

            $this->tableData = array_values($decoded);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->tableData = [];
            $this->errorMessage = 'Invalid JSON: ' . $e->getMessage();
        }
    }

    public function render()
    {
        // ✅ Ensure this returns a view, NOT a string
        return view('livewire.json-to-table');
    }
}

