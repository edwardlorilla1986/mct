<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON Stringifier - Convert Student JSON Data</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{
    "name": "David",
    "isStudent": true,
    "grade": 85,
    "subjects": ["Math", "Science"]
}'></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Stringified JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $stringifiedJson }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-success" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
