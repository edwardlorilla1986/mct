<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>TSV to JSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="tsvInput" class="form-label">Enter TSV Data:</label>
                <textarea id="tsvInput" wire:model="tsvInput" class="form-control" rows="5" placeholder='item	material	quantity
Hat	Wool	3
Gloves	Leather	5
Candle	Wax	4
Vase	Glass	2'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="useHeaders" wire:model="useHeaders" class="form-check-input">
                <label for="useHeaders" class="form-check-label">Treat First Row as Headers</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="ignoreEmptyLines" wire:model="ignoreEmptyLines" class="form-check-input">
                <label for="ignoreEmptyLines" class="form-check-label">Ignore Empty Lines</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="detectDataTypes" wire:model="detectDataTypes" class="form-check-input">
                <label for="detectDataTypes" class="form-check-label">Detect Data Types (Numbers & Booleans)</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="useTabs" wire:model="useTabs" class="form-check-input">
                <label for="useTabs" class="form-check-label">Indent with Tabs</label>
            </div>

            <div class="mb-3">
                <label for="indentationSize" class="form-label">Indentation Size (Spaces):</label>
                <input type="number" id="indentationSize" wire:model="indentationSize" class="form-control" min="0" max="8" step="2" value="2" {{ $useTabs ? 'disabled' : '' }}>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $jsonOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
