<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4>CSV to JSON Converter - Free Online Tool</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="csvInput" class="form-label">Enter CSV Data:</label>
                <textarea id="csvInput" wire:model="csvInput" class="form-control" rows="5" placeholder='name,grade,level,gpa
Kai,89,B,3.7
Jad,79,C,2.8'></textarea>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="useHeaders" wire:model="useHeaders" class="form-check-input">
                <label for="useHeaders" class="form-check-label">Convert Headers to JSON Keys</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="detectDataTypes" wire:model="detectDataTypes" class="form-check-input">
                <label for="detectDataTypes" class="form-check-label">Enable Dynamic Type Conversion</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox" id="skipEmptyLines" wire:model="skipEmptyLines" class="form-check-input">
                <label for="skipEmptyLines" class="form-check-label">Skip Empty Lines</label>
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
                <label for="commentChar" class="form-label">Comment Character:</label>
                <input type="text" id="commentChar" wire:model="commentChar" class="form-control" maxlength="1" value="#" placeholder="Enter comment character">
            </div>

            <div class="mb-3">
                <label class="form-label">Converted JSON Output:</label>
                <div class="alert alert-secondary" role="alert">
                    <pre class="mb-0">{{ $jsonOutput }}</pre>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-danger" wire:click="clearInput">Clear Input</button>
        </div>
    </div>
</div>
