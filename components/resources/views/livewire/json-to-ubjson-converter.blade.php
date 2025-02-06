<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">JSON to UBJSON Converter</h2>
        </div>
        <div class="card-body">
            <!-- File Upload -->
            <div class="mb-3">
                <label for="jsonFile" class="form-label">Upload JSON File:</label>
                <input type="file" id="jsonFile" wire:model="jsonFile" class="form-control">
                @error('jsonFile') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Convert Button -->
            <button wire:click="convert" class="btn btn-primary w-100">
                Convert to UBJSON
            </button>

            <!-- Output UBJSON -->
            @if($ubjsonOutput)
                <div class="mt-4 p-3 border rounded bg-light">
                    <h5 class="text-success">Converted UBJSON (Base64 Encoded):</h5>
                    <textarea class="form-control" rows="6" readonly>{{ $ubjsonOutput }}</textarea>
                </div>
            @endif
        </div>
    </div>
</div>
