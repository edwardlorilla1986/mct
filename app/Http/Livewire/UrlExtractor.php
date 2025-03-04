<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DOMDocument;
use Illuminate\Support\Facades\Log;

class UrlExtractor extends Component
{
    public $htmlInput = '<h1>Hello World</h1>
<p>Welcome to <a href="http://multiculturaltoolbox.com/">http://multiculturaltoolbox.com/</a> our website.</p>
<div>Go to https://google.com/ to find something.</div>
<button data-search="https://www.google.com/search?q=multiculturaltoolbox.com">Click here</button>.';
    public $outputFormat = 'plaintext';
    public $extractHref = true;
    public $extractPlainText = true;
    public $extractAttributes = false;
    public $sortResults = false;
    public $output = '';

    public function updatedHtmlInput()
    {
        $this->extractUrls();
    }

    public function updatedOutputFormat()
    {
        $this->extractUrls();
    }

    public function extractUrls()
    {
        try {
            $urls = [];

            // Extract URLs from HTML content
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($this->htmlInput);
            libxml_clear_errors();

            if ($this->extractHref) {
                foreach ($doc->getElementsByTagName('a') as $anchor) {
                    if ($anchor->hasAttribute('href')) {
                        $urls[] = $anchor->getAttribute('href');
                    }
                }
            }

            if ($this->extractPlainText) {
                preg_match_all('/https?:\/\/[^\s<>"\']+/', $this->htmlInput, $matches);
                $urls = array_merge($urls, $matches[0]);
            }

            if ($this->extractAttributes) {
                foreach ($doc->getElementsByTagName('*') as $element) {
                    foreach ($element->attributes as $attr) {
                        if (filter_var($attr->value, FILTER_VALIDATE_URL)) {
                            $urls[] = $attr->value;
                        }
                    }
                }
            }

            if ($this->sortResults) {
                sort($urls);
            }

            $urls = array_unique($urls);
            $this->formatOutput($urls);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->output = "Error processing input.";
        }
    }

    private function formatOutput($urls)
    {
        switch ($this->outputFormat) {
            case 'plaintext':
                $this->output = implode("\n", $urls);
                break;

            case 'json':
                $this->output = json_encode($urls, JSON_PRETTY_PRINT);
                break;

            case 'jsonline':
                $this->output = implode("\n", array_map(fn($url) => json_encode(['url' => $url]), $urls));
                break;

            case 'xml':
                $this->output = $this->convertToXML($urls);
                break;

            case 'yaml':
                $this->output = $this->convertToYAML($urls);
                break;

            case 'sql':
                $this->output = $this->convertToSQL($urls);
                break;

            case 'csv':
                $this->output = $this->convertToCSV($urls);
                break;

            case 'html':
                $this->output = htmlspecialchars($this->htmlInput);
                break;

            case 'php_array':
                $this->output = var_export($urls, true);
                break;

            case 'js_array':
                $this->output = "const urls = " . json_encode($urls, JSON_PRETTY_PRINT) . ";";
                break;

            default:
                $this->output = "Invalid format selected.";
                break;
        }
    }

    private function convertToXML($urls)
    {
        $xml = new \SimpleXMLElement('<urls/>');
        foreach ($urls as $url) {
            $xml->addChild('url', htmlspecialchars($url));
        }
        return $xml->asXML();
    }

    private function convertToYAML($urls)
    {
        return implode("\n", array_map(fn($url) => "- " . $url, $urls));
    }

    private function convertToSQL($urls)
    {
        $sql = "INSERT INTO urls (url) VALUES\n";
        $values = [];
        foreach ($urls as $url) {
            $values[] = "('" . addslashes($url) . "')";
        }
        return $sql . implode(",\n", $values) . ";";
    }

    private function convertToCSV($urls)
    {
        return "url\n" . implode("\n", $urls);
    }

    public function copyToClipboard()
    {
        $this->dispatchBrowserEvent('copy-output', ['output' => $this->output]);
    }

    public function render()
    {
        return view('livewire.url-extractor');
    }
}
