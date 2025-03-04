<div class="container mt-4">
    <h2 class="text-center">VK Video Downloader</h2>

    <div class="input-group mb-3">
        <input type="text" wire:model="videoUrl" class="form-control" placeholder="Enter VK video URL">
        <button wire:click="fetchVideo" class="btn btn-primary">Download</button>
    </div>

    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif

    @if ($videoData)
        <div class="card mt-4">
            <div class="card-body text-center">
                <h4 class="card-title">{{ $videoData['title'] }}</h4>
                @if ($videoData['thumbnail'])
                    <img src="{{ $videoData['thumbnail'] }}" class="img-fluid mb-3">
                @endif
                <div class="list-group">
                    @foreach ($videoData['videos'] as $video)
                        <a href="{{ $video['url'] }}" class="list-group-item list-group-item-action" download>
                            Download {{ $video['quality'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
