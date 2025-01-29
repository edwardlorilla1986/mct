<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class YouTubeDownloader extends Component
{
    public $videoUrl;
    public $downloadLink;

    public function fetchDownloadLinks()
{
    try {
        if (!$this->videoUrl) {
            session()->flash('error', 'Please enter a valid YouTube URL.');
            return;
        }

        // Extract Video ID from URL
        if (!preg_match('/v=([a-zA-Z0-9_-]+)/', $this->videoUrl, $matches)) {
            session()->flash('error', 'Invalid YouTube URL.');
            return;
        }

        // Define yt-dlp binary path and temp directory
        $binaryPath = '/home/eyygsv3j0a44/yt-dlp-bin/yt-dlp';
        $tempDir = '/home/eyygsv3j0a44/yt-dlp-temp';
        $command = "TMPDIR=$tempDir $binaryPath -f best --get-url '{$this->videoUrl}'";

        // Use proc_open() instead of shell_exec()
        $process = proc_open($command, [
            1 => ['pipe', 'w'], // Standard output
            2 => ['pipe', 'w'], // Standard error
        ], $pipes);

        if (!is_resource($process)) {
            session()->flash('error', 'Failed to execute command.');
            return;
        }

        $videoDirectUrl = stream_get_contents($pipes[1]); // Read output
        $errorOutput = stream_get_contents($pipes[2]); // Read errors

        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($process);

        if (!$videoDirectUrl) {
            Log::error('yt-dlp error: ' . $errorOutput);
            session()->flash('error', 'Failed to fetch video link.');
            return;
        }

        // Log output for debugging
        Log::info("yt-dlp output: " . $videoDirectUrl);

        // Set download link
        $this->downloadLink = trim($videoDirectUrl);
        session()->flash('success', 'Click the link below to download or watch the video.');

    } catch (\Exception $e) {
        Log::error('YouTube download error: ' . $e->getMessage());
        session()->flash('error', 'An unexpected error occurred. Please try again later.');
    }
}

    public function render()
    {
        return view('livewire.you-tube-downloader');
    }
}
