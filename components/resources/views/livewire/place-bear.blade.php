<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Bear Placeholder Image Generator</h4>
        </div>
        <div class="card-body text-center">
            <div class="mb-3">
                <label for="width" class="form-label">Width:</label>
                <input type="number" class="form-control w-25 d-inline-block" id="width" wire:model="width">

                <label for="height" class="form-label ms-3">Height:</label>
                <input type="number" class="form-control w-25 d-inline-block" id="height" wire:model="height">
            </div>

            <div class="mb-3">
                <input type="checkbox" id="grayscale" wire:model="grayscale">
                <label for="grayscale" class="ms-1">Grayscale</label>
            </div>

            <button class="btn btn-success mb-3" wire:click="generateImage">Generate Image</button>

            @if ($imageUrl)
                <div class="mt-4">
                    <h5>Generated Bear Image:</h5>
                    <img src="{{ $imageUrl }}" class="img-fluid rounded shadow-sm" alt="Bear Placeholder">
                    <p class="mt-2">
                        <strong>Direct URL:</strong> 
                        <a href="{{ $imageUrl }}" target="_blank">{{ $imageUrl }}</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
