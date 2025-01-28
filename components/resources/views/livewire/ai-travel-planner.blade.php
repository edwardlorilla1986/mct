<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Travel Planner</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateItinerary">
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" id="destination" class="form-control" wire:model="destination" placeholder="Enter your travel destination">
                        @error('destination') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="preferences" class="form-label">Preferences</label>
                        <textarea id="preferences" class="form-control" wire:model="preferences" rows="4" placeholder="Enter your preferences (e.g., adventure, relaxation, historical sites)"></textarea>
                        @error('preferences') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="budget" class="form-label">Budget ($)</label>
                        <input type="number" id="budget" class="form-control" wire:model="budget" placeholder="Enter your budget">
                        @error('budget') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Itinerary</span>
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

        @if($itinerary)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Itinerary</h5>
                    <pre style="white-space: pre-wrap;">{{ $itinerary }}</pre>
                </div>
            </div>
        @else
            <div class="text-muted">Enter your travel details above and click "Generate Itinerary" to see the results.</div>
        @endif
    </div>
</div>
