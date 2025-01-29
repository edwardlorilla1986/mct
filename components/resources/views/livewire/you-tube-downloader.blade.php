<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">YouTube Video Downloader</h2>
        </div>
        <div class="card-body">

            {{-- Error Message --}}
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- YouTube Input Form --}}
            <form wire:submit.prevent="fetchDownloadLinks">
                <div class="mb-3">
                    <label for="videoUrl" class="form-label fw-bold">YouTube URL:</label>
                    <input type="text" id="videoUrl" wire:model="videoUrl" class="form-control" placeholder="Enter YouTube URL">
                    @error('videoUrl') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-download"></i> Fetch Download Link
                </button>
            </form>

            {{-- Display Download Link --}}
            @if($downloadLink)
                <div class="mt-4">
                    <h4 class="fw-bold text-dark">Download Video</h4>
                    <a href="{{ $downloadLink }}" target="_blank" class="btn btn-success d-block">
                        <i class="bi bi-cloud-download"></i> Download Video
                    </a>
                </div>

                <div class="mt-4">
                    <h4 class="fw-bold text-dark">Watch Video</h4>
                    <div class="ratio ratio-16x9">
                        <video controls class="w-100 rounded">
                            <source src="{{ $downloadLink }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
