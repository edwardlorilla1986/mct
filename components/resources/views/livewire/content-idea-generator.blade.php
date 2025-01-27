<div>
    <div class="container mt-5">
        <h2 class="mb-4">Content Idea Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateIdeas">
                    <div class="mb-3">
                        <label for="keywords" class="form-label">Enter Keywords</label>
                        <input type="text" id="keywords" class="form-control" wire:model="keywords" placeholder="e.g., Technology, Health, Travel">
                        @error('keywords') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Ideas</span>
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

        @if($generatedIdeas)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Content Ideas</h5>
                    <ul>
                        @foreach($generatedIdeas as $idea)
                            <li>{{ $idea }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="text-muted">Enter keywords above and click "Generate Ideas" to see the result.</div>
        @endif
    </div>
</div>
