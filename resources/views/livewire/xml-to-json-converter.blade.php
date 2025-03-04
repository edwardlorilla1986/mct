<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>XML to JSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="xmlInput" class="form-label">Enter XML:</label>
                <textarea id="xmlInput" wire:model="xmlInput" class="form-control" rows="5" placeholder='<root>
  <color>red</color>
</root>'></textarea>
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
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
