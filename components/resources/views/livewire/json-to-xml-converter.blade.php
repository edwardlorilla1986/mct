<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON to XML Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{
  "brand": "Toyota",
  "model": "Corolla",
  "year": 2022
}'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="addMetaTag" wire:model="addMetaTag" class="form-check-input">
                <label for="addMetaTag" class="form-check-label">Add XML Meta Tag</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="keepMinified" wire:model="keepMinified" class="form-check-input">
                <label for="keepMinified" class="form-check-label">Keep XML Unformatted (Minified)</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="useTabs" wire:model="useTabs" class="form-check-input">
                <label for="useTabs" class="form-check-label">Use Tabs for Indentation</label>
            </div>

            <div class="mb-3">
                <label for="indentationSize" class="form-label">Indentation Size (Spaces):</label>
                <input type="number" id="indentationSize" wire:model="indentationSize" class="form-control" min="2" max="8" step="2" value="2" {{ $useTabs ? 'disabled' : '' }}>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted XML Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $xmlOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
