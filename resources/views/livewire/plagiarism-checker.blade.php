<div class="p-4 bg-light shadow rounded">
    <h1 class="h4 mb-4">Plagiarism Checker</h1>

    <form wire:submit.prevent="checkPlagiarism">
        <div class="mb-3">
            <label for="inputText" class="form-label">Enter Text</label>
            <textarea 
                wire:model="inputText" 
                id="inputText" 
                rows="6" 
                class="form-control" 
                placeholder="Paste your text here..."></textarea>
            @error('inputText') 
                <div class="text-danger small mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Check for Plagiarism
        </button>
    </form>

    @if($isLoading)
        <div class="alert alert-info mt-4">Checking for plagiarism...</div>
    @endif

    @if(!empty($matchedSources))
        <h2 class="h5 mt-4">Matched Sources</h2>
        <ul class="list-group mt-2">
            @foreach($matchedSources as $source)
                <li class="list-group-item">
                    <strong>{{ $source['title'] }}</strong>
                    <p>{{ $source['snippet'] }}</p>
                    <a href="{{ $source['url'] }}" class="text-decoration-none text-primary" target="_blank">View Source</a>
                </li>
            @endforeach
        </ul>
    @elseif($inputText && !$isLoading && empty($matchedSources))
        <div class="alert alert-success mt-4">
            No matches found. Your content appears to be original!
        </div>
    @endif
</div>
