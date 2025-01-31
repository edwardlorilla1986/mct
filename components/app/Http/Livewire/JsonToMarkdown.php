<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class JsonToMarkdown extends Component
{
    use WithFileUploads;

    public $jsonInput = '';
    public $markdownOutput = '';
    public $alignment = 'left';
    public $errorMessage = '';
    public $history = [];
    public $historyIndex = -1;
    public $uploadedFile;

    // Convert JSON to Markdown Table
    public function convertToMarkdown()
    {
        $this->errorMessage = '';

        if (empty($this->jsonInput)) {
            $this->markdownOutput = '';
            return;
        }

        // Validate JSON
        $decodedJson = json_decode($this->jsonInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->errorMessage = 'Invalid JSON format. Please check your input.';
            $this->markdownOutput = '';
            return;
        }

        // Save history for undo/redo
        $this->saveHistory();

        // Generate Markdown Table
        $this->markdownOutput = $this->generateMarkdownTable($decodedJson);
    }

    // Save history only if there's a change
    public function saveHistory()
    {
        if ($this->historyIndex === -1 || $this->jsonInput !== $this->history[$this->historyIndex]) {
            if ($this->historyIndex < count($this->history) - 1) {
                $this->history = array_slice($this->history, 0, $this->historyIndex + 1);
            }

            $this->history[] = $this->jsonInput;
            $this->historyIndex++;
        }
    }

    // Undo Functionality
    public function undo()
    {
        if ($this->historyIndex > 0) {
            $this->historyIndex--;
            $this->jsonInput = $this->history[$this->historyIndex];
            $this->convertToMarkdown();
        }
    }

    // Redo Functionality
    public function redo()
    {
        if ($this->historyIndex < count($this->history) - 1) {
            $this->historyIndex++;
            $this->jsonInput = $this->history[$this->historyIndex];
            $this->convertToMarkdown();
        }
    }

    // Clear Input and Output
    public function clearAll()
    {
        $this->jsonInput = '';
        $this->markdownOutput = '';
        $this->errorMessage = '';
        $this->history = [];
        $this->historyIndex = -1;
    }

    // Handle File Upload
    public function loadFromFile()
    {
        if ($this->uploadedFile) {
            $this->jsonInput = file_get_contents($this->uploadedFile->getRealPath());
            $this->convertToMarkdown();
            $this->saveHistory();
        }
    }

    // Generate Markdown Table
    private function generateMarkdownTable(array $data)
    {
        if (empty($data) || !isset($data[0]) || !is_array($data[0])) {
            return 'Invalid JSON structure. Expected an array of objects.';
        }

        // Extract headers
        $headers = array_keys($data[0]);
        $alignmentMap = [
            'left' => ':---',
            'center' => ':---:',
            'right' => '---:'
        ];
        $alignmentSyntax = [];
foreach ($headers as $h) {
    $alignmentSyntax[] = $alignmentMap[$this->alignment];
}

        // Build Markdown Table
        $markdown = '| ' . implode(' | ', $headers) . " |\n";
        $markdown .= '| ' . implode(' | ', $alignmentSyntax) . " |\n";

        foreach ($data as $row) {
            $values = array_map(function ($key) use ($row) {
    return $row[$key] ?? '';
}, $headers);
            $markdown .= '| ' . implode(' | ', $values) . " |\n";
        }

        return $markdown;
    }

    public function render()
    {
        return view('livewire.json-to-markdown');
    }
}
