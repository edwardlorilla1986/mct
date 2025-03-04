<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4>JSON to YAML Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{
  "fruit": "strawberry",
  "color": "red",
  "seasons": ["spring", "summer"],
  "vitamins": { "vitamin c": "high", "vitamin k": "moderate" }
}'></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted YAML Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $yamlOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
