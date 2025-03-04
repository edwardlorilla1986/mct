<div class="container mt-4 text-dark">
    <h2 class="mb-3 text-primary">Bencode to JSON Converter</h2>

    <!-- Sample Button -->
    <button wire:click="loadSample" class="btn btn-info mb-3">Load Sample</button>

    <!-- Bencode Input -->
    <div class="mb-3">
        <textarea wire:model="bencodeInput" class="form-control text-dark bg-light" rows="5" placeholder="Enter Bencode here..."></textarea>
    </div>

    <!-- Error Message -->
    @if ($errorMessage)
        <div class="alert alert-danger text-dark">{{ $errorMessage }}</div>
    @endif

    <!-- JSON Output -->
    @if ($jsonOutput)
        <div class="mb-3">
            <h4 class="text-dark">Converted JSON</h4>
            <pre class="border p-3 bg-light text-dark">{{ $jsonOutput }}</pre>
        </div>
        <button wire:click="downloadJson" class="btn btn-success text-dark">Download JSON</button>
    @endif
</div>
