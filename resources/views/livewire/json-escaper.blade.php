<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4>JSON Escaper - Escape Quotes & Line Breaks</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{"country": "Spain", "capital": "Madrid"}'></textarea>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" id="wrapInQuotes" wire:model="wrapInQuotes" class="form-check-input">
                <label for="wrapInQuotes" class="form-check-label">Wrap Output in Quotes</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Escaped JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $escapedJson }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
