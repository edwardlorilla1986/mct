<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Image Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateImage">
                    <div class="mb-3">
                        <label for="prompt" class="form-label">Prompt</label>
                        <input type="text" id="prompt" class="form-control" wire:model="prompt" placeholder="Describe the image (e.g., A beautiful landscape)">
                        @error('prompt') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="width" class="form-label">Width (px)</label>
                        <input type="number" id="width" class="form-control" wire:model="width" placeholder="1024">
                        @error('width') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Height (px)</label>
                        <input type="number" id="height" class="form-control" wire:model="height" placeholder="1024">
                        @error('height') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="seed" class="form-label">Seed</label>
                        <input type="number" id="seed" class="form-control" wire:model="seed" placeholder="42">
                        @error('seed') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" id="model" class="form-control" wire:model="model" placeholder="flux">
                        @error('model') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Image</span>
                        <span wire:loading>Generating...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif




        @if($generatedImage)
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Generated Image</h5>
                    <img src="{{ $generatedImage }}" alt="Generated Image" class="img-fluid mt-3">
                </div>
            </div>
        @else
            <div class="text-muted">Enter your preferences above and click "Generate Image" to see the result.</div>
        @endif
    </div>
</div>
