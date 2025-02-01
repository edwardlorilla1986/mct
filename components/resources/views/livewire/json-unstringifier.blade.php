<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h4>JSON Unstringifier - Convert Event Data JSON String</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonString" class="form-label">Enter Stringified JSON:</label>
                <textarea id="jsonString" wire:model="jsonString" class="form-control" rows="5" placeholder='"{\n  \"event\": {\n    \"title\": \"Movie Night\",\n    \"date\": \"Friday 13\",\n    \"time\": \"19:00\"\n  }\n}"'></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Unstringified JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $unstringifiedJson }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
