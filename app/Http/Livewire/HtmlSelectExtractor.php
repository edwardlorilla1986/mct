<?php
namespace App\Http\Livewire;

use Livewire\Component;
use DOMDocument;
use Illuminate\Support\Facades\Log;

class HtmlSelectExtractor extends Component
{
    public $htmlInput = '<select>
  <option value="apple">Apple</option>
  <option value="orange">Orange</option>
  <option value="carrot">Carrot</option>
  <option value="celery">Celery</option>
</select>';
    public $outputFormat = 'json';
    public $output = '';

    public function updatedHtmlInput()
    {
        $this->extractOptions();
    }

    public function updatedOutputFormat()
    {
        $this->extractOptions();
    }

    public function extractOptions()
    {
        try {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($this->htmlInput);
            libxml_clear_errors();
            
            $selectElements = $doc->getElementsByTagName('select');

            if ($selectElements->length === 0) {
                $this->output = "Invalid input. No <select> tag found.";
                return;
            }

            $options = [];
            foreach ($selectElements as $select) {
                foreach ($select->getElementsByTagName('option') as $option) {
                    $options[] = [
                        'value' => $option->getAttribute('value'),
                        'text'  => $option->nodeValue,
                    ];
                }
            }

            $this->formatOutput($options);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->output = "Error parsing HTML input.";
        }
    }

    private function formatOutput($options)
    {
        switch ($this->outputFormat) {
            case 'json':
                $this->output = json_encode($options, JSON_PRETTY_PRINT);
                break;

            case 'jsonline':
                $this->output = implode("\n", array_map(fn($item) => json_encode($item), $options));
                break;

            case 'yaml':
                $this->output = $this->convertToYaml($options);
                break;

            case 'sql':
                $this->output = $this->convertToSQL($options);
                break;

            case 'csv':
                $this->output = $this->convertToCSV($options);
                break;

            case 'html':
                $this->output = htmlspecialchars($this->htmlInput);
                break;

            case 'php_array':
                $this->output = var_export($options, true);
                break;

            case 'js_object':
                $this->output = "const options = " . json_encode($options, JSON_PRETTY_PRINT) . ";";
                break;

            case 'py_dict':
                $this->output = $this->convertToPythonDict($options);
                break;

            default:
                $this->output = "Invalid format selected.";
                break;
        }
    }

    private function convertToYaml($options)
    {
        $yaml = "";
        foreach ($options as $option) {
            $yaml .= "- value: " . $option['value'] . "\n  text: " . $option['text'] . "\n";
        }
        return $yaml;
    }

    private function convertToSQL($options)
    {
        $sql = "INSERT INTO options (value, text) VALUES\n";
        $values = [];
        foreach ($options as $option) {
            $values[] = "('" . addslashes($option['value']) . "', '" . addslashes($option['text']) . "')";
        }
        $sql .= implode(",\n", $values) . ";";
        return $sql;
    }

    private function convertToCSV($options)
    {
        $csv = "value,text\n";
        foreach ($options as $option) {
            $csv .= "{$option['value']},{$option['text']}\n";
        }
        return $csv;
    }

    private function convertToPythonDict($options)
    {
        return "[\n" . implode(",\n", array_map(fn($item) => "  {'value': '{$item['value']}', 'text': '{$item['text']}'}", $options)) . "\n]";
    }

    public function copyToClipboard()
    {
        $this->dispatchBrowserEvent('copy-output', ['output' => $this->output]);
    }

    public function render()
    {
        return view('livewire.html-select-extractor');
    }
}
