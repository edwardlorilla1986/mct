<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Name Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateNames">
                    <div class="mb-3">
                        <label for="nameStyle" class="form-label">Select Name Style</label>
                        <select id="nameStyle" class="form-select" wire:model="nameStyle">
                            <option value="Auto">Auto</option>
                            <option value="Brandable names">Brandable names</option>
                            <option value="Evocative">Evocative</option>
                            <option value="Short phrase">Short phrase</option>
                            <option value="Compound words">Compound words</option>
                            <option value="Alternate spelling">Alternate spelling</option>
                            <option value="Non-English words">Non-English words</option>
                            <option value="Real words">Real words</option>
                        </select>
                        @error('nameStyle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="randomness" class="form-label">Select Randomness Level</label>
                        <select id="randomness" class="form-select" wire:model="randomness">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                        @error('randomness') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keywords</label>
                        <input type="text" id="keywords" class="form-control" wire:model="keywords" placeholder="Enter relevant keywords">
                        @error('keywords') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Business Description (Optional)</label>
                        <textarea id="description" class="form-control" wire:model="description" rows="3" placeholder="Enter a short description of your business or idea"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Names</span>
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

        @if($generatedNames)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Names</h5>
                    <ul>
                        @foreach($generatedNames as $name)
                            <li>{{ $name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="text-muted">Enter details above and click "Generate Names" to see the results.</div>
        @endif
    </div>
</div>
