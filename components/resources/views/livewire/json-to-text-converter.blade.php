<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>JSON to Text Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{"name": "John", "age": 30}'></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted Plain Text Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $plainTextOutput }}</pre>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
            </div>
        </div>
    </div>
</div>
