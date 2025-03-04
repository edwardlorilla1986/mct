<div>
    <div class="container mt-5">
        <h1 class="text-center mb-4">AI Keyword Research Tool</h1>
        <div class="card shadow-sm p-4">
            <form wire:submit.prevent="generateKeywords">
                <div class="mb-3">
                    <label for="query" class="form-label">Enter a Topic or Query</label>
                    <input type="text" id="query" class="form-control" wire:model="query" placeholder="e.g., Digital Marketing" required>
                    @error('query') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" {{ $loading ? 'disabled' : '' }}>
                        {{ $loading ? 'Generating...' : 'Generate Keywords' }}
                    </button>
                </div>
            </form>
        </div>

        @if ($loading)
            <div class="text-center mt-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Generating keywords, please wait...</p>
            </div>
        @endif

        @if (!empty($keywords))
            <div class="card shadow-sm p-4 mt-4">
                <h3>Suggested Keywords:</h3>
                <ul class="list-group">
                    @foreach ($keywords as $keyword)
                        <li class="list-group-item">{{ $keyword }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
