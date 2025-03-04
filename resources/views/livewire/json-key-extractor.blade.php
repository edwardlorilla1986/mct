<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON Key Extractor - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{"name": "John", "age": 30, "address": {"city": "NY", "zip": "10001"}}'></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Extraction Depth:</label>
                <input type="text" wire:model="depth" class="form-control" placeholder="* (all) or 1,2,3">
                <small class="text-muted">Use "*" for all levels, or specify depths like "1, 2, 4" or "2-5".</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Key Separator:</label>
                <select wire:model="separator" class="form-select">
                    <option value="\n">New Line (\n)</option>
                    <option value=", ">Comma (,)</option>
                    <option value=" ">Space ( )</option>
                    <option value="|">Pipe (|)</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" wire:model="wrapQuotes" id="wrapQuotes">
                <label class="form-check-label" for="wrapQuotes">Wrap Keys in Quotes</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Extracted JSON Keys:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $extractedKeys }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
