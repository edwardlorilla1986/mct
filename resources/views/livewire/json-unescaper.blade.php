<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>JSON Unescaper - Remove Escape Characters & Format JSON</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter Escaped JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{\"city\": \"New York\", \"population\": 8000000, \"is_capital\": false}'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="prettify" wire:model="prettify" class="form-check-input">
                <label for="prettify" class="form-check-label">Prettify Output JSON</label>
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
                <label class="form-label">Unescaped JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $unescapedJson }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
