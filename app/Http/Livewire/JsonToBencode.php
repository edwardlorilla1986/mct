<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToBencode extends Component
{
    public $jsonInput = '';
    public $bencodeOutput = '';
    public $errorMessage = '';

    public function updatedJsonInput()
    {
        $this->convertJsonToBencode();
    }

    public function convertJsonToBencode()
    {
        try {
            $decoded = json_decode($this->jsonInput, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception(json_last_error_msg());
            }

            $this->bencodeOutput = $this->bencode($decoded);
            $this->errorMessage = '';
        } catch (\Exception $e) {
            $this->bencodeOutput = '';
            $this->errorMessage = 'Invalid JSON: ' . $e->getMessage();
        }
    }

    private function bencode($data)
    {
        if (is_integer($data)) {
            return 'i' . $data . 'e';
        } elseif (is_string($data)) {
            return strlen($data) . ':' . $data;
        } elseif (is_array($data)) {
            if (array_keys($data) === range(0, count($data) - 1)) {
                return 'l' . implode('', array_map([$this, 'bencode'], $data)) . 'e';
            } else {
                ksort($data);
                $encoded = 'd';
                foreach ($data as $key => $value) {
                    $encoded .= $this->bencode((string)$key) . $this->bencode($value);
                }
                return $encoded . 'e';
            }
        }
        return '';
    }

    public function downloadBencode()
    {
        return response()->streamDownload(function () {
            echo $this->bencodeOutput;
        }, 'converted.bencode');
    }

    public function render()
    {
        return view('livewire.json-to-bencode');
    }
}

// Blade Template (resources/views/livewire/json-to-bencode.blade.php)
?>