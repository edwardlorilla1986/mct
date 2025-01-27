<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AiLogoCreator extends Component
{
    public $prompt = 'A beautiful landscape';
    public $width = 1024;
    public $height = 1024;
    public $seed = 42;
    public $model = 'flux';
    public $generatedImage = '';
    public $loading = false;
    public $errorMessage = '';

    public function generateImage()
    {
        $this->validate([
            'prompt' => 'required|min:5',
            'width' => 'required|integer|min:256',
            'height' => 'required|integer|min:256',
            'seed' => 'required|integer',
            'model' => 'required|string',
        ]);

        $this->loading = true;
        $this->errorMessage = '';

        try {
             
            $imageUrl = "https://pollinations.ai/p/Generate a logo based on the following preferences {$this->prompt}?width={$this->width}&height={$this->height}&seed={$this->seed}&model={$this->model}";

            // Fetch the image content as a binary stream
            $response = Http::get($imageUrl);

            if ($response->successful()) {
                $this->generatedImage = 'data:image/jpeg;base64,' . base64_encode($response->body());
            } else {
                $this->errorMessage = 'Failed to generate the image. Please try again later.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred while processing your request: ' . $e->getMessage();
        }

        $this->loading = false;
    }


    public function render()
    {
        return view('livewire.ai-logo-creator');
    }
}
