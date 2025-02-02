<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">JSON Analyzer</h2>
        </div>
        <div class="card-body">
            <label class="form-label fw-bold">Enter JSON</label>
            <textarea wire:model="jsonInput" class="form-control text-dark border border-secondary" 
                      rows="5" placeholder="Paste your JSON here"></textarea>

            <div class="mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="printGeneralInfo">
                    <label class="form-check-label">Print General JSON Info</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="printDataTypes">
                    <label class="form-check-label">Print Data Type Statistics</label>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label fw-bold">Analyze Nested Data</label>
                <select wire:model="analyzeNestedData" class="form-select">
                    <option value="none">Don't Analyze Nested Data</option>
                    <option value="all">Analyze All Nested Data</option>
                    <option value="specific">Analyze Specific Nesting Level</option>
                </select>
                @if($analyzeNestedData == 'specific')
                    <input type="text" wire:model="nestedDepth" class="form-control mt-2" placeholder="Enter depth levels (e.g., 1, 3-4)">
                @endif
            </div>

            <button wire:click="analyzeJson" class="btn btn-primary mt-3 w-100">
                Analyze JSON
            </button>

            @if($analysisResult)
                <div class="mt-4">
                    <h3 class="fw-semibold">JSON Analysis Output:</h3>
                    <pre class="bg-light border p-3 rounded text-dark">{{ $analysisResult }}</pre>
                </div>
            @endif
        </div>
    </div>
</div>
