<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Properties to JSON Converter</h4>
                </div>
                <div class="card-body">
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- File Upload Option -->
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload Properties File</label>
                        <input type="file" wire:model="file" class="form-control">
                    </div>

                    <div class="text-center fw-bold my-2">OR</div>

                    <!-- Manual Text Input Option -->
                    <div class="mb-3">
                        <label for="textInput" class="form-label">Enter Properties Manually</label>
                        <textarea wire:model="textInput" class="form-control" rows="6" placeholder="Example:
name: Luisa
interests.0: Music
interests.1: Movies"></textarea>
                    </div>

                    <button wire:click="convertPropertiesToJson" class="btn btn-success w-100">
                        Convert to JSON
                    </button>

                    @if($jsonOutput)
                        <div class="mt-4">
                            <h5 class="text-primary">Converted JSON:</h5>
                            <pre class="bg-light p-3 rounded border">{{ $jsonOutput }}</pre>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
