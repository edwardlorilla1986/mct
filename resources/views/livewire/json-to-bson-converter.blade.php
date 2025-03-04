<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>JSON to BSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="jsonInput" class="form-label">Enter JSON:</label>
                <textarea id="jsonInput" wire:model="jsonInput" class="form-control" rows="5" placeholder='{
  "substance": "water",
  "formula": "H2O"
}'></textarea>
            </div>

            <div class="mb-3">
                <label for="fileName" class="form-label">File Name:</label>
                <input type="text" id="fileName" wire:model="fileName" class="form-control" value="output.bson" placeholder="Enter file name">
            </div>

            <div class="mb-3">
                <label class="form-label">Converted BSON (Hex Output):</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $bsonHexOutput }}</pre>
                </div>
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success" wire:click="downloadBson">Download BSON</button>
            </div>
        </div>
    </div>
</div>
