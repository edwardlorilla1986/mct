<div class="container mt-4">
    <h2 class="text-center text-primary">TikTok Video Downloader</h2>

    <div class="card shadow-sm p-4">
        <div class="mb-3">
            <input type="text" wire:model="videoUrl" class="form-control" placeholder="Enter TikTok video URL">
        </div>
        <button wire:click="fetchVideo" class="btn btn-primary w-100">Download</button>

        @if ($errorMessage)
            <div class="alert alert-danger mt-3">{{ $errorMessage }}</div>
        @endif

        @if ($videoData)
            <div class="mt-4 text-center">
                <h4 class="text-secondary">{{ $videoData['title'] }}</h4>
                <img src="{{ $videoData['thumbnail'] }}" alt="Thumbnail" class="img-fluid rounded shadow-sm">
                <a href="{{ $videoData['downloadUrl'] }}" class="btn btn-success mt-3" download>Download Video</a>
            </div>
        @endif
    </div>
</div>
