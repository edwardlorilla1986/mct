<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonToCsvConverter extends Component
{
    public $jsonInput = '';
    public $csvOutput = '';
    public $includeHeaders = true;
    public $alwaysQuote = true;
    public $delimiter = ',';
    public $quoteChar = '"';

    public function updatedJsonInput()
    {
        try {
            $decodedJson = json_decode($this->jsonInput, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->csvOutput = $this->convertJsonToCsv($decodedJson);
            } else {
                $this->csvOutput = 'Invalid JSON';
            }
        } catch (\Exception $e) {
            $this->csvOutput = 'Error processing JSON';
        }
    }

    private function convertJsonToCsv($data)
    {
        $csv = '';
        $delimiter = $this->delimiter;
        $quote = $this->quoteChar;
        $output = [];

        if (isset($data[0]) && is_array($data[0])) {
            if ($this->includeHeaders) {
                $headers = array_keys($data[0]);
                $output[] = implode($delimiter, array_map(fn($h) => $this->quoteField($h), $headers));
            }

            foreach ($data as $row) {
                $values = array_map(fn($v) => $this->quoteField($v), array_values($row));
                $output[] = implode($delimiter, $values);
            }
        } elseif (is_array($data) && isset($data[0]) && is_array($data[0])) {
            foreach ($data as $row) {
                $values = array_map(fn($v) => $this->quoteField($v), $row);
                $output[] = implode($delimiter, $values);
            }
        } else {
            foreach ($data as $key => $value) {
                $output[] = $this->quoteField($value);
            }
        }

        return implode("\n", $output);
    }

    private function quoteField($value)
    {
        if ($this->alwaysQuote) {
            return $this->quoteChar . str_replace($this->quoteChar, $this->quoteChar . $this->quoteChar, $value) . $this->quoteChar;
        }
        return $value;
    }

    public function clearInput()
    {
        $this->jsonInput = '';
        $this->csvOutput = '';
    }

    public function render()
    {
        return view('livewire.json-to-csv-converter');
    }
}
