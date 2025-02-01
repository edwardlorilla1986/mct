<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">JSON Flattener</h4>
        </div>
        <div class="card-body">
            <!-- JSON Input -->
            <div class="form-group">
                <label for="jsonInput">Enter JSON:</label>
                <textarea class="form-control" wire:model.lazy="jsonInput" rows="6" placeholder='{"key": "value"}'></textarea>
            </div>

            <!-- Flattening Depth -->
            <div class="row">
                <div class="col-md-6">
                    <label for="depth">Flatten Depth:</label>
                    <input type="text" class="form-control" wire:model.lazy="depth" placeholder="* (all levels)">
                </div>

                <div class="col-md-6">
                    <label for="separator">Key Separator:</label>
                    <select class="form-control" wire:model="separator">
                        <option value=".">Dot (.)</option>
                        <option value="_">Underscore (_)</option>
                        <option value="-">Hyphen (-)</option>
                    </select>
                </div>
            </div>

            <!-- Convert Button -->
            <div class="mt-3">
                <button class="btn btn-success w-100" wire:click="flattenJson">Flatten JSON</button>
            </div>

            <!-- Output -->
            @if($flattenedJson)
            <div class="mt-4">
                <label>Flattened JSON Output:</label>
                <pre class="bg-light p-3 border rounded">{{ $flattenedJson }}</pre>
            </div>
            @endif
        </div>
    </div>
</div>
