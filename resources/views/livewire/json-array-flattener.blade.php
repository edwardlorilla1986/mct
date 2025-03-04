<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON Array Flattener - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON Array:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='[["cat", "dog"], ["bird", "fish"], ["mouse", "raccoon"]]'></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Flattening Depth:</label>
                <input type="text" wire:model="depth" class="form-control" placeholder="* (all) or 1,2">
                <small class="text-muted">Use "*" for full flattening or specify depth like "1,2".</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Output Format:</label>
                <select wire:model="format" class="form-select">
                    <option value="minified">Minified JSON</option>
                    <option value="tabs">Tab Indented</option>
                    <option value="spaces">Space Indented</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Flattened JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $flattenedJson }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
