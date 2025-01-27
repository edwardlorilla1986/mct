<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Meta Description Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateMetaDescription">
                    <div class="mb-3">
                        <label for="pageTitle" class="form-label">Page Title</label>
                        <input type="text" id="pageTitle" class="form-control" wire:model="pageTitle" placeholder="Enter the title of the page">
                        @error('pageTitle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pageContent" class="form-label">Page Content</label>
                        <textarea id="pageContent" class="form-control" wire:model="pageContent" rows="5" placeholder="Enter the main content of the page"></textarea>
                        @error('pageContent') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Meta Description</span>
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

        @if($generatedDescription)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Meta Description</h5>
                    <p>{{ $generatedDescription }}</p>
                </div>
            </div>
        @else
            <div class="text-muted">Enter the page details above and click "Generate Meta Description" to see the result.</div>
        @endif
    </div>
</div>
