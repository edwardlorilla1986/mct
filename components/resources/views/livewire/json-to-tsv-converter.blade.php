<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON to TSV Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='[
  {
    "city": "Berlin",
    "density": "4,213/km²",
    "population": "3645495"
  },
  {
    "city": "Madrid",
    "density": "5,300/km²",
    "population": "3223408"
  }
]'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="generateHeaders" wire:model="generateHeaders" class="form-check-input">
                <label for="generateHeaders" class="form-check-label">Generate Column Headers</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="wrapFieldsInQuotes" wire:model="wrapFieldsInQuotes" class="form-check-input">
                <label for="wrapFieldsInQuotes" class="form-check-label">Wrap All Fields in Quotes</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Converted TSV Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $tsvOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
