<?php

namespace App\Http\Livewire;

use Livewire\Component;

class JsonCensor extends Component
{
    public $jsonInput;
    public $censoredJson;
    public $stringCensors = '';
    public $stringReplacement = '***';
    public $censorKeys = '';
    public $keyReplacement = '[HIDDEN]';
    public $censorNumbers = '';
    public $numberReplacement = 0;
    public $indentType = 'space';
    public $indentSize = 2;
    public $caseSensitive = false;
    public $maskEachSymbol = false;
    public $matchFullWords = false;

    public function censorJson()
    {
        if (!$this->jsonInput) {
            $this->censoredJson = 'Invalid JSON input';
            return;
        }

        try {
            $data = json_decode($this->jsonInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Invalid JSON format");
            }

            $stringCensors = array_filter(array_map('trim', explode("\n", $this->stringCensors)));
            $keyCensors = array_filter(array_map('trim', explode("\n", $this->censorKeys)));
            $numberCensors = array_filter(array_map('trim', explode("\n", $this->censorNumbers)));

            $censoredData = $this->applyCensorship($data, $stringCensors, $keyCensors, $numberCensors);

            $jsonOptions = JSON_UNESCAPED_UNICODE | ($this->indentType === 'none' ? 0 : JSON_PRETTY_PRINT);
            $formattedJson = json_encode($censoredData, $jsonOptions);

            if ($this->indentType === 'tab') {
                $formattedJson = str_replace('  ', "\t", $formattedJson);
            }

            $this->censoredJson = $formattedJson;
        } catch (\Exception $e) {
            $this->censoredJson = "Error: " . $e->getMessage();
        }
    }

    private function applyCensorship($data, $stringCensors, $keyCensors, $numberCensors)
    {
        if (is_array($data)) {
            $censored = [];
            foreach ($data as $key => $value) {
                $newKey = in_array($key, $keyCensors) ? $this->getMaskedString($key, $this->keyReplacement) : $key;
                $censored[$newKey] = $this->applyCensorship($value, $stringCensors, $keyCensors, $numberCensors);
            }
            return $censored;
        } elseif (is_string($data)) {
            foreach ($stringCensors as $censor) {
                $data = $this->replaceString($data, $censor, $this->stringReplacement);
            }
            return $data;
        } elseif (is_numeric($data)) {
            foreach ($numberCensors as $censor) {
                if (strpos($censor, '-') !== false) {
                    [$min, $max] = explode('-', $censor);
                    if ($data >= (float)$min && $data <= (float)$max) {
                        return $this->numberReplacement;
                    }
                } elseif ((float)$data === (float)$censor) {
                    return $this->numberReplacement;
                }
            }
        }
        return $data;
    }

    private function replaceString($text, $search, $replacement)
    {
        if (!$this->caseSensitive) {
            $text = str_ireplace($search, $this->getMaskedString($search, $replacement), $text);
        } else {
            $text = str_replace($search, $this->getMaskedString($search, $replacement), $text);
        }
        return $text;
    }

    private function getMaskedString($text, $replacement)
    {
        return $this->maskEachSymbol ? str_repeat($replacement, strlen($text)) : $replacement;
    }

    public function render()
    {
        return view('livewire.json-censor');
    }
}
