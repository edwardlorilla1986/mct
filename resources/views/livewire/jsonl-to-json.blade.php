<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">JSONL to JSON Converter</h2>
        </div>
        <div class="card-body">
            
            {{-- File Upload Section --}}
            <div class="mb-4">
                <label class="form-label fw-bold"><i class="bi bi-upload"></i> Upload JSONL File:</label>
                <input type="file" wire:model="jsonlFile" class="form-control">
                @error('jsonlFile') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- OR Manual Input Section --}}
            <div class="mb-4">
                <label class="form-label fw-bold"><i class="bi bi-pencil-square"></i> Or Enter JSONL Data Manually:</label>
                <textarea wire:model="manualJsonl" rows="5" class="form-control" placeholder='{"name": "Alice", "age": 25}&#10;{"name": "Bob", "age": 30}'></textarea>
            </div>

            {{-- Convert Button --}}
            <div class="d-flex justify-content-center">
                <button wire:click="convert" class="btn btn-success px-4 py-2">
                    <i class="bi bi-arrow-repeat"></i> Convert
                </button>
            </div>

            {{-- Display Converted JSON --}}
            @if($convertedJson)
                <div class="mt-4">
                    <h4 class="fw-bold"><i class="bi bi-file-earmark-code"></i> Converted JSON:</h4>
                    <pre class="bg-light p-3 border rounded text-dark">{{ $convertedJson }}</pre>

                    {{-- Download Button --}}
                    <div class="d-flex justify-content-center mt-3">
                        <button wire:click="downloadJson" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-download"></i> Download JSON
                        </button>
                    </div>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session()->has('error'))
                <div class="alert alert-danger mt-3"><i class="bi bi-exclamation-triangle"></i> {{ session('error') }}</div>
            @endif

        </div>
    </div>
</div>
