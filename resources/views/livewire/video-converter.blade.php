<div class="card shadow-lg p-4">
    <h2 class="text-center mb-3">Upload Video</h2>

    @if(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <input type="file" class="form-control" wire:model="video">
        @error('video') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary w-100" wire:click="uploadVideo" wire:loading.attr="disabled">
        <span wire:loading.remove>Upload Video</span>
        <span wire:loading>Uploading...</span>
    </button>

    @if ($uploadedUrl)
        <div class="mt-4">
            <h4>Video Uploaded Successfully!</h4>
            <video controls width="100%" class="border rounded">
                <source src="{{ $uploadedUrl }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <a href="{{ $uploadedUrl }}" class="btn btn-success mt-3 w-100" target="_blank">Download Video</a>
        </div>
    @endif
</div>
