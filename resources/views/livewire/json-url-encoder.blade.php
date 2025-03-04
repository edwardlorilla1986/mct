<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON URL-Encoder - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{"url": "https://example.com"}'></textarea>
            </div>

            <div class="form-check my-2">
                <input type="checkbox" id="fullEscape" wire:model="fullEscape" class="form-check-input">
                <label for="fullEscape" class="form-check-label">Full Character Escape</label>
            </div>

            @if($fullEscape)
            <div class="form-check my-2">
                <input type="checkbox" id="uppercaseEncoding" wire:model="uppercaseEncoding" class="form-check-input">
                <label for="uppercaseEncoding" class="form-check-label">Use Uppercase Hex Encoding</label>
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label">URL-Encoded Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $urlEncodedOutput }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
