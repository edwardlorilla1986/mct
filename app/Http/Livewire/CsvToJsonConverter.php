<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CsvToJsonConverter extends Component
{
    public $csvInput = '';
    public $jsonOutput = '';
    public $useHeaders = true;
    public $skipEmptyLines = true;
    public $detectDataTypes = true;
    public $useTabs = false;
    public $indentationSize = 2;
    public $delimiter = ',';
    public $quoteChar = '"';
    public $commentChar = '#';

    public function updatedCsvInput()
    {
        try {
            $this->jsonOutput = $this->convertCsvToJson($this->csvInput);
        } catch (\Exception $e) {
            $this->jsonOutput = 'Error processing CSV data';
        }
    }

    private function convertCsvToJson($csv)
    {
        $lines = explode("\n", trim($csv));
        $jsonArray = [];
        $headers = [];

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments & empty lines
            if ($this->skipEmptyLines && empty($line)) {
                continue;
            }
            if (strpos($line, $this->commentChar) === 0) {
                continue;
            }

            $fields = str_getcsv($line, $this->delimiter, $this->quoteChar);

            // Use the first row as headers
            if ($this->useHeaders && empty($headers)) {
                $headers = $fields;
                continue;
            }

            if ($this->useHeaders) {
                $jsonItem = [];
                foreach ($fields as $key => $value) {
                    $jsonItem[$headers[$key]] = $this->detectDataTypes ? $this->convertDataType($value) : $value;
                }
                $jsonArray[] = $jsonItem;
            } else {
                $jsonArray[] = array_map(fn($v) => $this->detectDataTypes ? $this->convertDataType($v) : $v, $fields);
            }
        }

        return $this->formatJsonOutput($jsonArray);
    }

    private function convertDataType($value)
    {
        if (is_numeric($value)) {
            return $value + 0;
        } elseif (strtolower($value) === 'true' || strtolower($value) === 'false') {
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        }
        return $value;
    }

    private function formatJsonOutput($data)
    {
        $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
        if ($this->indentationSize > 0) {
            $options |= JSON_PRETTY_PRINT;
            $jsonString = json_encode($data, $options);
            if ($this->useTabs) {
                $jsonString = str_replace("    ", "\t", $jsonString);
            } else {
                $jsonString = str_replace("\t", str_repeat(" ", $this->indentationSize), $jsonString);
            }
        } else {
            $jsonString = json_encode($data, $options);
        }

        return $jsonString;
    }

    public function clearInput()
    {
        $this->csvInput = '';
        $this->jsonOutput = '';
    }

    public function render()
    {
        return view('livewire.csv-to-json-converter');
    }
}
