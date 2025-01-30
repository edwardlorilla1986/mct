<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VkDownloader extends Component
{
    public $videoUrl;
    public $videoData = [];
    public $errorMessage;

    public function fetchVideo()
    {
        // Reset previous data
        $this->reset(['videoData', 'errorMessage']);

        // Validate input
        if (!$this->videoUrl || !filter_var($this->videoUrl, FILTER_VALIDATE_URL)) {
            $this->errorMessage = "Please enter a valid VK video URL.";
            return;
        }

        // Extract Video ID
        $videoId = $this->extractVideoId($this->videoUrl);
        if (!$videoId) {
            $this->errorMessage = "Invalid VK video URL format.";
            return;
        }

        // Fetch Video Data
        $response = $this->fetchVideoData($videoId);
        
        Log::error($response);
        if ($response && isset($response['medias']) && !empty($response['medias'])) {
            $this->videoData = [
                'title' => $response['title'] ?? 'VK Video',
                'thumbnail' => $response['thumbnail'] ?? null,
                'videos' => $response['medias'],
            ];
        } else {
            $this->errorMessage = "Unable to retrieve video details. Please check the URL and try again.";
        }
    }

    private function fetchVideoData($videoId)
    {
        try {
            $apiUrl = "https://vk.com/al_video.php?act=show";

            $response = Http::asForm()->withHeaders([
                'x-requested-with' => 'XMLHttpRequest',
                'referer' => 'https://vk.com',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->post($apiUrl, [
                'act' => 'show',
                'al' => 1,
                'autoplay' => 0,
                'list' => '',
                'module' => 'videocat',
                'video' => $videoId,
            ]);
            
            Log::error($response);

            if ($response->successful()) {
                return $this->parseVideoData($response->body());
            } else {
                Log::error("VK API Request Failed: " . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error("VK API Error: " . $e->getMessage());
            return null;
        }
    }

    private function extractVideoId($url)
    {
        preg_match('/video(-?\d+)_(\d+)/', $url, $matches);
        return isset($matches[0]) ? $matches[0] : null;
    }

    private function parseVideoData($data)
    {
        $videos = [];
        preg_match_all('/"url(\d{3})":"(.*?)"/', $data, $matches);

        if (!empty($matches[1]) && !empty($matches[2])) {
            foreach ($matches[1] as $key => $quality) {
                $videoUrl = str_replace("\\", "", $matches[2][$key]);
                $videos[] = [
                    'quality' => $quality . 'p',
                    'url' => $videoUrl,
                ];
            }
        }

        return [
            'title' => 'VK Video',
            'thumbnail' => $this->extractThumbnail($data),
            'medias' => $videos,
        ];
    }

    private function extractThumbnail($data)
    {
        preg_match('/"poster":"(.*?)"/', $data, $matches);
        if (!empty($matches[1])) {
            return str_replace("\\", "", $matches[1]);
        }

        preg_match('/"og:image" content="(.*?)"/', $data, $altMatches);
        return !empty($altMatches[1]) ? str_replace("\\", "", $altMatches[1]) : null;
    }

    public function render()
    {
        return view('livewire.vk-downloader');
    }
}
