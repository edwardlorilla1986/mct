<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PlaceBear extends Component
{
    public $width = 300;
    public $height = 300;
    public $grayscale = false;
    public $imageUrl;

    public function mount()
    {
        $this->generateImage();
    }

    public function generateImage()
    {
        $baseUrl = "https://placebear.com/";
        $path = $this->grayscale ? "g/{$this->width}/{$this->height}" : "{$this->width}/{$this->height}";
        $this->imageUrl = $baseUrl . $path;
    }

    public function render()
    {
        return view('livewire.place-bear');
    }
}
