<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class VideoConverter extends Component
{
    use WithFileUploads;

    public $video;
    public $uploadedUrl;
    public $uploading = false;
public function checkGitHubWorkflowStatus()
{
    $githubRepo = env('GITHUB_REPO');
    $workflowUrl = "https://api.github.com/repos/$githubRepo/actions/runs";

    $response = Http::withHeaders([
        'Authorization' => 'token ' . env('GITHUB_TOKEN'),
        'Accept' => 'application/vnd.github.v3+json',
    ])->get($workflowUrl);

    if ($response->successful()) {
        $runs = $response->json()['workflow_runs'] ?? [];
        foreach ($runs as $run) {
            if ($run['status'] === 'completed' && $run['conclusion'] === 'success') {
                return response()->json([
                    'status' => 'completed',
                    'converted_url' => "https://raw.githubusercontent.com/$githubRepo/main/uploads/converted_" . basename($run['head_branch']) . ".webm"
                ]);
            }
        }
    }

    return response()->json(['status' => 'processing']);
}
    public function uploadVideo()
    {
        $this->validate([
            'video' => 'required|mimes:mp4|max:50000', // Limit 50MB
        ]);

        $this->uploading = true;

        // Get video file content
        $file = $this->video->getRealPath();
        $fileName = time() . '_' . $this->video->getClientOriginalName();
        $fileContent = base64_encode(file_get_contents($file));

        // Upload to GitHub Repository
        $githubRepo = env('GITHUB_REPO');
        $uploadUrl = "https://api.github.com/repos/$githubRepo/contents/uploads/$fileName";

        $response = Http::withHeaders([
            'Authorization' => 'token ' . env('GITHUB_TOKEN'),
            'Accept' => 'application/vnd.github.v3+json',
        ])->put($uploadUrl, [
            'message' => 'Upload video via Livewire',
            'content' => $fileContent,
        ]);

        if ($response->successful()) {
            
            $responseData = $response->json();
            $this->uploadedUrl = $responseData['content']['download_url'] ?? null;
           
        } else {
            session()->flash('error', 'Upload failed.');
        }

        $this->uploading = false;
    }

    public function render()
    {
        return view('livewire.video-converter');
    }
}
