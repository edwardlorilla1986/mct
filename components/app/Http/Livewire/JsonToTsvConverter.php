<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToTsvConverter extends Component
{
    public $jsonInput = '';
    public $tsvOutput = '';
    public $generateHeaders = true;
    public $wrapFieldsInQuotes = true;

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->tsvOutput = $this->convertJsonToTsv($decodedJson);
            } else {
                $this->tsvOutput = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->tsvOutput = 'Error processing JSON';
        }
    }

    private function convertJsonToTsv($data)
    {
        $tsv = '';
        $separator = "\t";
        $quote = $this->wrapFieldsInQuotes ? '"' : '';

        if (isset($data[0]) && is_array($data[0])) {
            if ($this->generateHeaders) {
                $headers = array_keys($data[0]);
                $tsv .= implode($separator, array_map(fn($h) => $quote . $h . $quote, $headers)) . "\n";
            }

            foreach ($data as $row) {
                $values = array_map(fn($v) => $quote . str_replace('"', '""', $v) . $quote, array_values($row));
                $tsv .= implode($separator, $values) . "\n";
            }
        } elseif (is_array($data) && isset($data[0]) && is_array($data[0])) {
            foreach ($data as $row) {
                $values = array_map(fn($v) => $quote . str_replace('"', '""', $v) . $quote, $row);
                $tsv .= implode($separator, $values) . "\n";
            }
        }

        return trim($tsv);
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->tsvOutput = '';
    }

    public function render()
    {
        return view('livewire.json-to-tsv-converter');
    }
}
