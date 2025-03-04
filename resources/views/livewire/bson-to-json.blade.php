<div class="container mt-5">
    <div class="card shadow-lg bg-dark text-light">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">BSON to JSON Converter</h2>
        </div>
        <div class="card-body">
            
            {{-- File Upload Section --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-light"><i class="bi bi-upload"></i> Upload BSON File:</label>
                <input type="file" wire:model="bsonFile" class="form-control bg-dark text-light border-light">
                @error('bsonFile') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- OR Manual Input Section --}}
            <div class="mb-4">
                <label class="form-label fw-bold text-light"><i class="bi bi-pencil-square"></i> Or Enter BSON Data (Base64 Encoded):</label>
                <textarea wire:model="manualBson" rows="5" class="form-control bg-dark text-light border-light" placeholder="Paste BSON data here"></textarea>
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
                    <h4 class="fw-bold text-light"><i class="bi bi-file-earmark-code"></i> Converted JSON:</h4>
                    <pre class="bg-secondary text-light p-3 border border-light rounded">{{ $convertedJson }}</pre>

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
