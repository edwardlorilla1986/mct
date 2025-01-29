<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TiktokDownloader extends Component
{
    public $videoUrl;
    public $videoData = null;
    public $errorMessage = '';

    public function fetchVideo()
    {
        $this->errorMessage = '';
        $this->videoData = null;
        
        if (!$this->videoUrl) {
            $this->errorMessage = 'Please enter a TikTok video URL.';
            return;
        }

        try {
            $response = Http::get('https://www.tikwm.com/api/', [
                'url' => $this->videoUrl,
            ]);

            $data = $response->json();
            if (isset($data['data']['play'])) {
                $this->videoData = [
                    'title' => $data['data']['title'] ?? 'TikTok Video',
                    'thumbnail' => $data['data']['cover'] ?? '',
                    'downloadUrl' => $data['data']['play'] ?? '',
                ];
            } else {
                $this->errorMessage = 'Failed to retrieve video. Please check the URL and try again.';
            }
        } catch (\Exception $e) {
            $this->errorMessage = 'Error fetching video: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.tiktok-downloader');
    }
}
