<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4>JSON to CSV Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='[
  {
    "planet": "earth",
    "size": "400"
  },
  {
    "planet": "mars",
    "size": "500"
  },
  {
    "planet": "jupiter",
    "size": "9000"
  }
]'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="includeHeaders" wire:model="includeHeaders" class="form-check-input">
                <label for="includeHeaders" class="form-check-label">Include Column Headers</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="alwaysQuote" wire:model="alwaysQuote" class="form-check-input">
                <label for="alwaysQuote" class="form-check-label">Always Quote Fields</label>
            </div>

            <div class="mb-3">
                <label for="delimiter" class="form-label">Field Separator (Delimiter):</label>
                <input type="text" id="delimiter" wire:model="delimiter" class="form-control" maxlength="1" value="," placeholder="Enter delimiter (, ; |)">
            </div>

            <div class="mb-3">
                <label for="quoteChar" class="form-label">Quote Character:</label>
                <input type="text" id="quoteChar" wire:model="quoteChar" class="form-control" maxlength="1" value='"' placeholder="Enter quote character">
            </div>

            <div class="mb-3">
                <label class="form-label">Converted CSV Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $csvOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
