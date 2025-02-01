<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>JSON to Base64 Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{"hello": "world"}'></textarea>
            </div>

            <div class="form-check my-2">
                <input type="checkbox" id="useChunking" wire:model="useChunking" class="form-check-input">
                <label for="useChunking" class="form-check-label">Chunkify Base64 Output</label>
            </div>

            @if($useChunking)
            <div class="mb-3">
                <label for="chunkSize" class="form-label">Chunk Size (symbols per line):</label>
                <input type="number" id="chunkSize" wire:model="chunkSize" class="form-control" min="16" max="256">
            </div>
            @endif

            <div class="form-check my-2">
                <input type="checkbox" id="generateDataUrl" wire:model="generateDataUrl" class="form-check-input">
                <label for="generateDataUrl" class="form-check-label">Generate Data URL</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Base64 Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $base64Output }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
