
<div class="container mt-4 text-dark">
    <h2 class="mb-3 text-primary">JSON to TOML Converter</h2>

    <!-- JSON Input -->
    <div class="mb-3">
        <textarea wire:model="jsonInput" class="form-control text-dark bg-light" rows="5" placeholder="Enter JSON here..."></textarea>
    </div>

    <!-- Error Message -->
    @if ($errorMessage)
        <div class="alert alert-danger text-dark">{{ $errorMessage }}</div>
    @endif

    <!-- TOML Output -->
    @if ($tomlOutput)
        <div class="mb-3">
            <h4 class="text-dark">Converted TOML</h4>
            <pre class="border p-3 bg-light text-dark">{{ $tomlOutput }}</pre>
        </div>
        <button wire:click="downloadToml" class="btn btn-success text-dark">Download TOML</button>
    @endif
</div>
