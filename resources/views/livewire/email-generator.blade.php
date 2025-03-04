<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Email Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateEmail">
                    <div class="mb-3">
                        <label for="inputDetails" class="form-label">Enter Email Details</label>
                        <textarea id="inputDetails" class="form-control" wire:model="inputDetails" rows="5" placeholder="Enter details for the email (e.g., recipient, purpose, tone)..."></textarea>
                        @error('inputDetails') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Email</span>
                        <span wire:loading>Generating...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($generatedEmail)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Email</h5>
                    <div>{{ $generatedEmail }}</div>
                </div>
            </div>
        @else
            <div class="text-muted">Enter details above and click "Generate Email" to see the result.</div>
        @endif
    </div>
</div>
