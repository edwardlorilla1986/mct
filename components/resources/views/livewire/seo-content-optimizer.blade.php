<div>
    <div class="container mt-5">
        <h2 class="mb-4">SEO Content Optimizer</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="analyzeContent">
                    <div class="mb-3">
                        <label for="focusKeyword" class="form-label">Focus Keyword</label>
                        <input type="text" id="focusKeyword" class="form-control" wire:model="focusKeyword" placeholder="Enter the focus keyword">
                        @error('focusKeyword') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea id="content" class="form-control" wire:model="content" rows="8" placeholder="Paste your content here"></textarea>
                        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Analyze Content</span>
                        <span wire:loading>Analyzing...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($optimizationSuggestions)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Optimization Suggestions</h5>
                    <ul>
                        @foreach($optimizationSuggestions as $suggestion)
                            <li>{{ $suggestion }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="text-muted">Enter your content above and click "Analyze Content" to see the suggestions.</div>
        @endif
    </div>
</div>
