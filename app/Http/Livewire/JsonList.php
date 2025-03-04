<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonList extends Component
{
    public $jsonInput = '';
    public $listData = [];
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

            $this->listData = is_array($decoded) ? $decoded : [$decoded];
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->listData = [];
            $this->errorMessage = 'Invalid JSON: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.json-list');
    }
}

// Blade Template (resources/views/livewire/json-to-list.blade.php)
?>