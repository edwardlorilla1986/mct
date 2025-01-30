<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Image to ASCII Converter</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="convertToAscii">
                <div class="mb-3">
                    <label class="form-label">Upload an Image (Max 1MB)</label>
                    <input type="file" class="form-control" wire:model="image">
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Width (10-200 characters)</label>
                    <input type="number" class="form-control w-25" wire:model="width" min="10" max="200">
                    @error('width') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" wire:model="useColor" id="useColor">
                    <label class="form-check-label" for="useColor">Use Color</label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" wire:model="invert" id="invert">
                    <label class="form-check-label" for="invert">Invert (black background)</label>
                </div>

                <button type="submit" class="btn btn-success mt-2">Convert to ASCII</button>
            </form>
        </div>
    </div>

    @if ($ascii)
        <div class="card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">ASCII Output</h5>
            </div>
            <div class="card-body">
                  <div class="ascii-output" style="font-family: monospace; white-space: pre; line-height: 1.2;">
            {!! $ascii !!}
        </div>
            </div>
        </div>
    @endif
</div>
