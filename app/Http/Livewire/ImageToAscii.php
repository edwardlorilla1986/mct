<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class ImageToAscii extends Component
{
    use WithFileUploads;

    public $image;
    public $ascii;
    public $width = 80;
    public $useColor = false;
    public $invert = false;

    protected $rules = [
        'image' => 'image|max:1024', // Max 1MB
        'width' => 'integer|min:10|max:200'
    ];

    public function convertToAscii()
    {
        $this->validate();

        if (!$this->image) {
            return;
        }

        // Process the image
        $path = $this->image->getRealPath();
        $img = Image::make($path)->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Define ASCII characters (from dark to light)
        $asciiChars = "@%#*+=-:. ";
        if ($this->invert) {
            $asciiChars = strrev($asciiChars);
        }

        $asciiArt = "";
        for ($y = 0; $y < $img->height(); $y++) {
            for ($x = 0; $x < $img->width(); $x++) {
                $pixel = $img->pickColor($x, $y);
                $gray = ($pixel[0] + $pixel[1] + $pixel[2]) / 3; // Convert to grayscale
                $charIndex = (int)(($gray / 255) * (strlen($asciiChars) - 1));
                $char = $asciiChars[$charIndex];

                if ($this->useColor) {
                    $char = "<span style='color:rgb({$pixel[0]},{$pixel[1]},{$pixel[2]})'>{$char}</span>";
                }

                $asciiArt .= $char;
            }
            $asciiArt .= "<br>";
        }

        $this->ascii = $asciiArt;
    }

    public function render()
    {
        return view('livewire.image-to-ascii');
    }
}
