<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>JSON Validator - Check JSON Validity</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON to Validate:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{
  "fruits": ["apple", "banana"]
}'></textarea>
            </div>

            @if($isValid !== null)
                <div class="mb-3">
                    @if($isValid)
                        <div class="alert alert-success">
                            ✅ {{ $validationMessage }}
                        </div>
                    @else
                        <div class="alert alert-danger">
                            ❌ {{ $validationMessage }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-warning" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
