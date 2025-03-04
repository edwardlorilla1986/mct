<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Article Writer</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateArticle">
                    <div class="mb-3">
                        <label for="keywords" class="form-label">Enter Keywords or Topic</label>
                        <input type="text" id="keywords" class="form-control" wire:model="keywords" placeholder="e.g., Artificial Intelligence">
                        @error('keywords') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Article</span>
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

        @if($generatedArticle)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Article</h5>
                    <div>{{ $generatedArticle }}</div>
                </div>
            </div>
        @else
            <div class="text-muted">Enter keywords and click "Generate Article" to see the result.</div>
        @endif
    </div>
</div>