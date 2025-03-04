<?php
namespace App\Http\Livewire;

use Livewire\Component;

class CitationGenerator extends Component
{
    public $references = [];
    public $newReference = [
        'author' => '',
        'title' => '',
        'year' => '',
        'publisher' => '',
        'format' => 'APA',
    ];
    public $selectedFormat = 'APA';

    public function addReference()
    {
        $this->validate([
            'newReference.author' => 'required',
            'newReference.title' => 'required',
            'newReference.year' => 'required|numeric',
            'newReference.publisher' => 'required',
        ]);

        $this->references[] = $this->newReference;
        $this->reset('newReference');
    }

    public function deleteReference($index)
    {
        unset($this->references[$index]);
        $this->references = array_values($this->references);
    }

    public function formatReference($reference)
    {
        switch ($reference['format']) {
            case 'APA':
                return "{$reference['author']} ({$reference['year']}). {$reference['title']}. {$reference['publisher']}";

            case 'MLA':
                return "{$reference['author']}. \"{$reference['title']}\". {$reference['publisher']}, {$reference['year']}.";

            case 'Chicago':
                return "{$reference['author']}. {$reference['title']}. {$reference['publisher']}, {$reference['year']}.";

            default:
                return '';
        }
    }

    public function render()
    {
        return view('livewire.citation-generator');
    }
}
