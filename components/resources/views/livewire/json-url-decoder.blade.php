<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4>JSON URL-Decoder - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="encodedJsonInput" class="form-label">Enter URL-encoded JSON:</label>
                <textarea id="encodedJsonInput" wire:model="encodedJsonInput" class="form-control" rows="5" placeholder="%7B%22name%22%3A%22John%22%7D"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Decoded JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $decodedJsonOutput }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
